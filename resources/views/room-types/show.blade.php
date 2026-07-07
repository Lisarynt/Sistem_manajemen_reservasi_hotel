<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Tipe Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Container Utama --}}
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 space-y-6">
                
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#FACC15] bg-amber-500/10 px-2.5 py-1 rounded-md">
                            Kategori Unit
                        </span>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $roomType->name }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Tarif Dasar</p>
                        <p class="text-xl font-black text-[#FACC15] mt-0.5">
                            Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}<span class="text-xs font-normal text-gray-400 dark:text-zinc-500">/malam</span>
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-100 dark:border-zinc-800/60"></div>

                {{-- Blok Informasi Deskripsi --}}
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Deskripsi & Spesifikasi Fasilitas</label>
                    <div class="bg-gray-50/50 dark:bg-zinc-950/30 border border-gray-100 dark:border-zinc-800/60 rounded-xl p-5">
                        <p class="text-sm text-gray-600 dark:text-zinc-300 leading-relaxed whitespace-pre-line">
                            {{ $roomType->description ?? 'Tidak ada deskripsi tambahan untuk tipe kamar ini.' }}
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-100 dark:border-zinc-800/60 pt-2"></div>

                {{-- Tombol Navigasi Kembali --}}
                <div class="flex items-center text-xs font-bold uppercase tracking-wider">
                    <a href="{{ route('room-types.index') }}" class="inline-flex items-center bg-gray-50 dark:bg-zinc-800 text-gray-700 dark:text-zinc-300 border border-gray-200 dark:border-zinc-700 hover:bg-gray-100 dark:hover:bg-zinc-700 px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>