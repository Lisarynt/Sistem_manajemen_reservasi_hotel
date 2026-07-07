<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $guests = Guest::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('id_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('guests.index', compact('guests', 'search'));
    }

    public function create()
    {
        return view('guests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:guests,email',
            'phone' => 'required|string|max:20',
            'id_number' => 'required|string|unique:guests,id_number',
            'address' => 'nullable|string',
        ]);

        Guest::create($validated);

        return redirect()->route('guests.index')->with('success', 'Data tamu berhasil ditambahkan.');
    }

    public function show(Guest $guest)
    {
        $guest->load('bookings.room');
        return view('guests.show', compact('guest'));
    }

    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:guests,email,' . $guest->id,
            'phone' => 'required|string|max:20',
            'id_number' => 'required|string|unique:guests,id_number,' . $guest->id,
            'address' => 'nullable|string',
        ]);

        $guest->update($validated);

        return redirect()->route('guests.index')->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function destroy(Guest $guest)
    {
        // Cegah hapus tamu yang masih punya booking aktif (data integrity)
        if ($guest->bookings()->whereIn('status', ['pending', 'confirmed', 'checked_in'])->exists()) {
            return back()->with('error', 'Tamu ini masih memiliki booking aktif, tidak bisa dihapus.');
        }

        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}