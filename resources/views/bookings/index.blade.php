<x-app-layout>
    <x-slot name="header">Booking</x-slot>
    <x-slot name="subheader">Kelola reservasi tamu hotel</x-slot>

    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 p-6">

        <div class="flex justify-between items-center mb-5">
            <h3 class="font-sans text-lg font-bold text-gray-900 dark:text-gray-100">Daftar Booking</h3>
            <a href="{{ route('bookings.create') }}"
               class="bg-zinc-900 text-white dark:bg-[#FACC15] dark:text-zinc-900 px-4 py-2.5 rounded-xl hover:bg-zinc-800 dark:hover:bg-amber-500 transition text-sm font-semibold tracking-wide shadow-sm">
                + Buat Booking
            </a>
        </div>

        <form method="GET" action="{{ route('bookings.index') }}" class="mb-5">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari kode booking atau nama tamu..."
                class="w-full md:w-1/3 rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] shadow-sm py-2.5">
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-zinc-800">
                        <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Kode</th>
                        <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Tamu</th>
                        <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Kamar</th>
                        <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Check-In</th>
                        <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Check-Out</th>
                        <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Status</th>
                        <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-zinc-800/50">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/30 transition-colors">
                            <td class="py-3.5 px-3 text-sm font-semibold text-gray-950 dark:text-gray-200">{{ $booking->booking_code }}</td>
                            <td class="py-3.5 px-3 text-sm text-gray-700 dark:text-gray-300">{{ $booking->guest->name }}</td>
                            <td class="py-3.5 px-3 text-sm text-gray-700 dark:text-gray-300">
                                <span class="bg-gray-100 dark:bg-zinc-800 text-gray-800 dark:text-gray-200 px-2.5 py-1 rounded-md font-mono text-xs">
                                    {{ $booking->room->room_number }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 text-sm text-gray-600 dark:text-gray-400">{{ $booking->checkin_date->format('d/m/Y') }}</td>
                            <td class="py-3.5 px-3 text-sm text-gray-600 dark:text-gray-400">{{ $booking->checkout_date->format('d/m/Y') }}</td>
                            <td class="py-3.5 px-3">
                             
                                <span class="text-xs px-2.5 py-1 rounded-full font-bold uppercase tracking-wide
                                    @if($booking->status === 'checked_in') bg-green-50 text-green-700 dark:bg-green-950/30 dark:text-green-400
                                    @elseif($booking->status === 'pending') bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-[#FACC15]
                                    @elseif($booking->status === 'confirmed') bg-blue-50 text-blue-700 dark:bg-blue-950/30 dark:text-blue-400
                                    @elseif($booking->status === 'checked_out') bg-gray-100 text-gray-600 dark:bg-zinc-800 dark:text-gray-400
                                    @else bg-red-50 text-red-700 dark:bg-red-950/30 dark:text-red-400 @endif">
                                    {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3">
                                <div class="flex items-center justify-end gap-1.5">

                                    <a href="{{ route('bookings.show', $booking) }}" title="Detail"
                                       class="w-8 h-8 flex items-center justify-center rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-zinc-800 dark:text-gray-400 dark:hover:bg-zinc-700 transition shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>

                                    <a href="{{ route('bookings.edit', $booking) }}" title="Edit"
                                       class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 dark:bg-amber-400/10 dark:text-[#FACC15] transition shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>

                                    @if (in_array($booking->status, ['pending', 'confirmed']))
                                        <form action="{{ route('bookings.checkin', $booking) }}" method="POST">
                                            @csrf
                                            {{-- Check-In --}}
                                            <button type="submit" title="Check-In"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-green-50 text-green-700 hover:bg-green-100 dark:bg-green-400/10 dark:text-green-400 transition shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                                            </button>
                                        </form>
                                    @endif

                                    @if ($booking->status === 'checked_in')
                                        <form action="{{ route('bookings.checkout', $booking) }}" method="POST">
                                            @csrf
                                            {{-- Check-Out --}}
                                            <button type="submit" title="Check-Out"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-zinc-900 text-white hover:bg-zinc-800 dark:bg-[#FACC15] dark:text-zinc-900 transition shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h3a3 3 0 013 3v1" /></svg>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- QR Code --}}
                                    <a href="{{ route('bookings.qrcode', $booking) }}" target="_blank" title="QR Code"
                                       class="w-8 h-8 flex items-center justify-center rounded-xl bg-zinc-100 text-zinc-800 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-200 transition shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-4h-4m4 0v4m-4-8H4m4 0V4m0 4v4m8-8h4m-4 0v4m4-4h-4m4 4v4m0-4h-4" /></svg>
                                    </a>

                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Yakin hapus booking ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus"
                                            class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-950/30 dark:text-red-400 transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-400 dark:text-gray-500 italic text-sm">Belum ada data booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $bookings->links() }}
        </div>
    </div>
</x-app-layout>