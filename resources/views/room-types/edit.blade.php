<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Tipe Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Container Utama --}}
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 space-y-6">
                
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Formulir Perubahan Kategori</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Sesuaikan nama kategori, rincian fasilitas detail, serta standardisasi tarif harga per malam.</p>
                </div>

                <div class="border-t border-gray-100 dark:border-zinc-800/60"></div>

                {{-- FORM INPUT DATA --}}
                <form action="{{ route('room-types.update', $roomType) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Nama Tipe Kamar --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Nama Tipe Kamar</label>
                            <input type="text" name="name" value="{{ old('name', $roomType->name) }}" placeholder="Contoh: Presidential Suite"
                                   class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5">
                            @error('name') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Harga per Malam --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Harga per Malam (Rp)</label>
                            <input type="number" name="price_per_night" value="{{ old('price_per_night', $roomType->price_per_night) }}" placeholder="Contoh: 1500000"
                                   class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5">
                            @error('price_per_night') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Deskripsi & Fasilitas Kamar --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Deskripsi & Rincian Fasilitas</label>
                        <textarea name="description" rows="5" placeholder="Tuliskan spesifikasi detail mengenai tipe kamar ini, luas kasur, pemandangan jendela, ketersediaan bathtub, dll..."
                                  class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5 leading-relaxed">{{ old('description', $roomType->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="border-t border-gray-100 dark:border-zinc-800/60 pt-4 mt-6"></div>

                    <div class="flex items-center space-x-3 text-xs font-bold uppercase tracking-wider">
                        <button type="submit" class="bg-[#FACC15] text-zinc-950 px-5 py-2.5 rounded-xl hover:bg-amber-500 transition-colors shadow-sm">
                            Update Tipe
                        </button>
                        <a href="{{ route('room-types.index') }}" class="bg-gray-50 dark:bg-zinc-800 text-gray-700 dark:text-zinc-300 border border-gray-200 dark:border-zinc-700 hover:bg-gray-100 dark:hover:bg-zinc-700 px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>