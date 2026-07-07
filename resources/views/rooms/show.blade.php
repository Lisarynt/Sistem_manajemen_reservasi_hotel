<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Unit Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Hero Card Container --}}
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 flex flex-col md:flex-row min-h-[450px]">
                
                {{-- SISI KIRI: HERO IMAGE & GALLERY --}}
                <div class="w-full md:w-1/2 bg-gray-50 dark:bg-zinc-950 p-6 flex flex-col justify-between border-b md:border-b-0 md:border-r border-gray-100 dark:border-zinc-800">
                    <div class="space-y-4">
                        {{-- Foto Utama Besar (Hero) --}}
                        <div class="relative aspect-[4/3] w-full overflow-hidden rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 bg-zinc-800 flex items-center justify-center">
                            @if ($room->images && $room->images->count())
                                <img src="{{ Storage::url($room->images->first()->image_path) }}" 
                                     id="mainHeroImage"
                                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="text-center p-6 text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs font-medium">Belum ada foto unit kamar</span>
                                </div>
                            @endif

                            {{-- Floating Status Badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm
                                    @if($room->status === 'available') bg-green-500 text-white
                                    @elseif($room->status === 'occupied') bg-red-500 text-white
                                    @else bg-amber-500 text-zinc-950 @endif">
                                    {{ $room->status }}
                                </span>
                            </div>
                        </div>

                        {{-- Galeri Thumbnail Kecil di Bawah --}}
                        @if ($room->images && $room->images->count() > 1)
                            <div class="flex flex-wrap gap-2">
                                @foreach ($room->images as $image)
                                    <button onclick="document.getElementById('mainHeroImage').src='{{ Storage::url($image->image_path) }}'" 
                                            class="w-14 h-14 object-cover rounded-lg overflow-hidden border-2 border-transparent hover:border-[#FACC15] focus:border-[#FACC15] transition-all shadow-sm bg-zinc-800">
                                        <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Tombol Aksi Kembali --}}
                    <div class="pt-6 border-t border-gray-200/60 dark:border-zinc-800 mt-6 md:mt-0">
                        <a href="{{ route('rooms.index') }}" class="inline-block w-full bg-gray-50 dark:bg-zinc-800 text-gray-700 dark:text-zinc-300 border border-gray-200 dark:border-zinc-700 hover:bg-gray-100 dark:hover:bg-zinc-700 px-4 py-2.5 rounded-xl text-center text-xs font-bold uppercase tracking-wider transition-colors shadow-sm">
                            &larr; Kembali ke Daftar
                        </a>
                    </div>
                </div>

                {{-- SISI KANAN: SPESIFIKASI, DESKRIPSI & HARGA --}}
                <div class="w-full md:w-1/2 p-8 flex flex-col justify-between space-y-6">
                    <div class="space-y-6">
                        {{-- Identitas Kamar --}}
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-[#FACC15] bg-[#FACC15]/10 px-2.5 py-1 rounded-md">
                                {{ $room->roomType->name ?? 'Tipe Tidak Ditemukan' }}
                            </span>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-2.5">Kamar {{ $room->room_number }}</h3>
                        </div>

                        {{-- Panel Harga Kamar (Diambil dari Relasi Type) --}}
                        <div class="bg-gray-50 dark:bg-zinc-800/40 border border-gray-100 dark:border-zinc-800/60 p-4 rounded-xl">
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Harga per Malam</span>
                            <div class="text-xl font-black text-gray-950 dark:text-white mt-1">
                               Rp {{ number_format((float) ($room->roomType->price_per_night ?? 0), 0, ',', '.') }}<span class="text-xs font-normal text-gray-400 dark:text-zinc-500"> / malam</span>
                            </div>
                        </div>

                        {{-- Deskripsi Tipe Kamar --}}
                        <div class="space-y-2">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-zinc-500">Deskripsi & Fasilitas Tipe</h4>
                            <p class="text-xs text-gray-600 dark:text-zinc-400 leading-relaxed italic">
                                {{ $room->roomType->description ?? 'Tidak ada deskripsi tambahan untuk tipe kamar ini.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Quick Metadata --}}
                    <div class="pt-4 border-t border-gray-100 dark:border-zinc-800 text-[10px] text-gray-400 dark:text-zinc-500 flex justify-between">
                        <span>Sistem Manajemen StayEase</span>
                        <span>Unit ID: #{{ $room->id }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>