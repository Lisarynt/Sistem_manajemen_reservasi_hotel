<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Data
        $totalRooms = Room::count();
        $totalGuests = Guest::count();
        $totalBookings = Booking::count();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');

        // Statistik status kamar
        $roomStatus = Room::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $occupiedRooms = $roomStatus->get('occupied', 0);
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 1) : 0;

        // Statistik status booking
        $bookingStatus = Booking::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Grafik booking per bulan (6 bulan terakhir)
        $bookingsPerMonth = Booking::select(
                DB::raw("DATE_FORMAT(checkin_date, '%Y-%m') as month"),
                DB::raw('count(*) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Grafik kamar terlaris
        $popularRoomTypes = RoomType::withCount('rooms')
            ->get()
            ->map(function ($type) {
                $bookingCount = Booking::whereHas('room', function ($q) use ($type) {
                    $q->where('room_type_id', $type->id);
                })->count();
                return ['name' => $type->name, 'total' => $bookingCount];
            });

        // Reservasi terbaru
        $recentBookings = Booking::with('guest', 'room')->latest()->take(4)->get();

        // Check-in hari ini (berdasarkan tanggal checkin_date)
        $todayCheckins = Booking::with('guest', 'room')
            ->whereDate('checkin_date', today())
            ->take(4)
            ->get();

        return view('dashboard', compact(
            'totalRooms', 'totalGuests', 'totalBookings', 'totalRevenue',
            'roomStatus', 'bookingStatus', 'bookingsPerMonth', 'popularRoomTypes',
            'occupancyRate', 'recentBookings', 'todayCheckins'
        ));
    }
}