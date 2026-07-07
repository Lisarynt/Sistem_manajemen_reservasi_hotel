<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::latest()->paginate(10);
        return view('room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('room-types.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        RoomType::create($validated);

        return redirect()->route('room-types.index')->with('success', 'Tipe kamar berhasil ditambahkan.');
    }

    public function show(RoomType $roomType)
    {
        return view('room-types.show', compact('roomType'));
    }

    public function edit(RoomType $roomType)
    {
        $this->authorizeAdmin();
        return view('room-types.edit', compact('roomType'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        $roomType->update($validated);

        return redirect()->route('room-types.index')->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    public function destroy(RoomType $roomType)
    {
        $this->authorizeAdmin();

        $roomType->delete();

        return redirect()->route('room-types.index')->with('success', 'Tipe kamar berhasil dihapus.');
    }

    /**
     * Helper: cuma admin yang boleh CRUD, petugas read-only.
     */
    private function authorizeAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang memiliki akses ini.');
        }
    }
}