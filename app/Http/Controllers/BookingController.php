<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $bookings = Booking::with('guest', 'room')
            ->when($search, function ($query, $search) {
                $query->where('booking_code', 'like', "%{$search}%")
                      ->orWhereHas('guest', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('bookings.index', compact('bookings', 'search'));
    }

    public function create()
    {
        $guests = Guest::all();
        $rooms = Room::where('status', 'available')->get();
        $facilities = Facility::all();

        return view('bookings.create', compact('guests', 'rooms', 'facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        $booking = Booking::create([
            'guest_id' => $validated['guest_id'],
            'room_id' => $validated['room_id'],
            'booking_code' => 'BK-' . strtoupper(Str::random(6)),
            'checkin_date' => $validated['checkin_date'],
            'checkout_date' => $validated['checkout_date'],
            'status' => 'pending',
        ]);

        if ($request->filled('facilities')) {
            $booking->facilities()->attach($request->facilities);
        }

        // Update status kamar jadi occupied (biar nggak dibooking ganda)
        $booking->room->update(['status' => 'occupied']);

        // Kirim email konfirmasi kalau tamu punya email
        if ($booking->guest->email) {
            try {
                Mail::to($booking->guest->email)->send(new BookingConfirmationMail($booking));
            } catch (\Exception $e) {
                // Email gagal terkirim tidak boleh menggagalkan proses booking
                report($e);
            }
        }

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat dengan kode ' . $booking->booking_code);
    }

    public function show(Booking $booking)
    {
        $booking->load('guest', 'room.roomType', 'facilities', 'payments');
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $guests = Guest::all();
        $rooms = Room::where('status', 'available')->orWhere('id', $booking->room_id)->get();
        $facilities = Facility::all();
        $booking->load('facilities');

        return view('bookings.edit', compact('booking', 'guests', 'rooms', 'facilities'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        $booking->update($validated);
        $booking->facilities()->sync($request->facilities ?? []);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        // Kembalikan status kamar jadi available kalau booking dihapus
        $booking->room->update(['status' => 'available']);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }

    /**
     * Proses Check-In
     */
    public function checkin(Booking $booking)
    {
        if ($booking->status !== 'confirmed' && $booking->status !== 'pending') {
            return back()->with('error', 'Booking ini tidak bisa di check-in (status: ' . $booking->status . ').');
        }

        $booking->update([
            'status' => 'checked_in',
            'actual_checkin_at' => now(),
        ]);

        $booking->room->update(['status' => 'occupied']);

        return back()->with('success', 'Tamu berhasil check-in.');
    }

    /**
     * Proses Check-Out
     */
    public function checkout(Booking $booking)
    {
        if ($booking->status !== 'checked_in') {
            return back()->with('error', 'Booking ini belum check-in, tidak bisa check-out.');
        }

        $booking->update([
            'status' => 'checked_out',
            'actual_checkout_at' => now(),
        ]);

        $booking->room->update(['status' => 'available']);

        return back()->with('success', 'Tamu berhasil check-out.');
    }

    /**
     * Generate QR Code berisi kode booking
     */
    public function qrcode(Booking $booking)
    {
        $verifyUrl = route('bookings.verify', $booking->booking_code);
        $qrcode = QrCode::size(250)->generate($verifyUrl);

        return view('bookings.qrcode', compact('booking', 'qrcode', 'verifyUrl'));
    }

    /**
     * Halaman publik (tanpa login) buat verifikasi booking lewat scan QR.
     * Dipanggil resepsionis/tamu pas scan QR saat check-in.
     */
    public function verify($code)
    {
        $booking = Booking::with('guest', 'room.roomType')
            ->where('booking_code', $code)
            ->firstOrFail();

        return view('bookings.verify', compact('booking'));
    }
}