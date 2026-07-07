<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Unit Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Container Utama --}}
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 space-y-6">
                
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Formulir Pembaruan Kamar</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Ubah spesifikasi, status operasional, atau kelola berkas dokumentasi foto kamar.</p>
                </div>

                <div class="border-t border-gray-100 dark:border-zinc-800/60"></div>

                {{-- DOKUMENTASI FOTO GUEST ROOM --}}
                @if ($room->images->count())
                    <div class="space-y-3">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Foto Saat Ini</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach ($room->images as $image)
                                <div class="relative group w-24 h-24 rounded-xl overflow-hidden border border-gray-200 dark:border-zinc-700 shadow-sm bg-zinc-800">
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover">
                                    
                                    {{-- Floating Delete Button Overlay --}}
                                    <form action="{{ route('room-images.destroy', $image) }}" method="POST" class="absolute top-1 right-1 opacity-90 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus gambar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white rounded-full p-1 shadow hover:bg-red-600 transition-colors focus:outline-none" title="Hapus Foto">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- FORM EDIT DATA --}}
                <form action="{{ route('rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Nomor Kamar --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Nomor Kamar</label>
                            <input type="text" name="room_number" value="{{ old('room_number', $room->room_number) }}" 
                                   class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5">
                            @error('room_number') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tipe Kamar --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Tipe Kamar</label>
                            <select name="room_type_id" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 dark:bg-zinc-800 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5">
                                @foreach ($roomTypes as $type)
                                    <option value="{{ $type->id }}" {{ $room->room_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('room_type_id') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Status Kamar --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Status Operasional</label>
                        <select name="status" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 dark:bg-zinc-800 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5">
                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                    </div>

                    {{-- Unggah File Foto --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Tambah Foto Baru (Opsional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-200 dark:border-zinc-700 border-dashed rounded-xl cursor-pointer bg-gray-50/30 dark:bg-zinc-800/10 hover:bg-gray-50 dark:hover:bg-zinc-800/30 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-3 pb-3 text-center">
                                    <svg class="w-6 h-6 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    <p class="text-xs text-gray-500 dark:text-zinc-400 font-medium">Klik untuk menambahkan beberapa berkas foto</p>
                                </div>
                                <input type="file" name="images[]" multiple accept="image/*" class="hidden">
                            </label>
                        </div>
                        @error('images.*') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="border-t border-gray-100 dark:border-zinc-800/60 pt-4 mt-6"></div>

                    {{-- Grup Tombol Submit & Batalkan --}}
                    <div class="flex items-center space-x-3 text-xs font-bold uppercase tracking-wider">
                        {{-- Tombol Utama: Kuning Emas, Teks Hitam Pekat --}}
                        <button type="submit" class="bg-[#FACC15] text-zinc-950 px-5 py-2.5 rounded-xl hover:bg-amber-500 transition-colors shadow-sm">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('rooms.index') }}" class="bg-gray-50 dark:bg-zinc-800 text-gray-700 dark:text-zinc-300 border border-gray-200 dark:border-zinc-700 hover:bg-gray-100 dark:hover:bg-zinc-700 px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>