<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType', 'images')->latest()->paginate(10);
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        $roomTypes = RoomType::all();
        return view('rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|unique:rooms,room_number',
            'status' => 'required|in:available,occupied,maintenance',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $room = Room::create([
            'room_type_id' => $validated['room_type_id'],
            'room_number' => $validated['room_number'],
            'status' => $validated['status'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms', 'public');
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function show(Room $room)
    {
        $room->load('roomType', 'images');
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $this->authorizeAdmin();
        $roomTypes = RoomType::all();
        $room->load('images');
        return view('rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'status' => 'required|in:available,occupied,maintenance',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $room->update([
            'room_type_id' => $validated['room_type_id'],
            'room_number' => $validated['room_number'],
            'status' => $validated['status'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms', 'public');
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        $this->authorizeAdmin();

        // Hapus semua file gambar fisik sebelum hapus data
        foreach ($room->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }

    /**
     * Hapus 1 gambar spesifik (dipanggil dari tombol hapus per gambar di form edit)
     */
    public function destroyImage(RoomImage $image)
    {
        $this->authorizeAdmin();

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    private function authorizeAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang memiliki akses ini.');
        }
    }
}