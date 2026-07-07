<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tipe Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Alert Notifikasi Sukses --}}
            @if (session('success'))
                <div class="mb-5 p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-900 text-green-800 dark:text-green-400 rounded-xl text-sm flex items-center shadow-sm">
                    <svg class="w-4 h-4 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Main Table Card Container --}}
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-6 space-y-5">
                
                {{-- Header Tabel & Tombol Tambah Data --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Daftar Kategori & Tipe Kamar</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Kelola konfigurasi dasar tipe kamar, fasilitas akomodasi, dan tarif manajemen penginapan.</p>
                    </div>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('room-types.create') }}" class="inline-flex items-center bg-[#FACC15] hover:bg-amber-500 text-zinc-950 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors shadow-sm whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Tipe Kamar
                        </a>
                    @endif
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-zinc-800">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-50/70 dark:bg-zinc-950/40 border-b border-gray-100 dark:border-zinc-800 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-zinc-500">
                                <th class="px-5 py-3.5">Nama Tipe</th>
                                <th class="px-5 py-3.5">Deskripsi Fasilitas</th>
                                <th class="px-5 py-3.5">Harga / Malam</th>
                                <th class="px-5 py-3.5 text-right">Aksi Kontrol</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/60 text-gray-600 dark:text-zinc-300">
                            @forelse ($roomTypes as $roomType)
                                <tr class="hover:bg-gray-50/40 dark:hover:bg-zinc-800/10 transition-colors">
                                    {{-- Nama Tipe Kamar --}}
                                    <td class="px-5 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $roomType->name }}
                                    </td>
                                    {{-- Deskripsi Kamar --}}
                                    <td class="px-5 py-4 text-xs max-w-xs text-gray-500 dark:text-zinc-400 leading-relaxed">
                                        {{ Str::limit($roomType->description, 50) }}
                                    </td>
                                    {{-- Harga per Malam --}}
                                    <td class="px-5 py-4 font-medium text-gray-900 dark:text-zinc-200">
                                        Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 text-right whitespace-nowrap text-xs font-bold uppercase tracking-wider">
                                        <div class="inline-flex items-center space-x-1.5">
                                            <a href="{{ route('room-types.show', $roomType) }}" class="px-2.5 py-1.5 rounded-lg text-gray-600 dark:text-zinc-300 bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 transition-colors">
                                                Detail
                                            </a>
                                            @if (auth()->user()->role === 'admin')
                                                <a href="{{ route('room-types.edit', $roomType) }}" class="px-2.5 py-1.5 rounded-lg text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/20 hover:bg-amber-100 dark:hover:bg-amber-950/40 transition-colors">
                                                    Edit
                                                </a>
                                                <form action="{{ route('room-types.destroy', $roomType) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus tipe kamar ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-2.5 py-1.5 rounded-lg text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/20 hover:bg-red-100 dark:hover:bg-red-950/40 transition-colors">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-10 text-center text-sm text-gray-400 dark:text-zinc-500 italic">
                                        <svg class="w-8 h-8 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/>
                                        </svg>
                                        Belum ada basis data tipe kamar yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                @if ($roomTypes->hasPages())
                    <div class="pt-2">
                        {{ $roomTypes->links() }}
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>