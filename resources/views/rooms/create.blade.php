<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Unit Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Container Utama --}}
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 space-y-6">
                
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Formulir Kamar Baru</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Daun dan daftarkan unit kamar baru ke dalam sistem operasional StayEase.</p>
                </div>

                <div class="border-t border-gray-100 dark:border-zinc-800/60"></div>

                {{-- FORM INPUT DATA --}}
                <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Nomor Kamar --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Nomor Kamar</label>
                            <input type="text" name="room_number" value="{{ old('room_number') }}" placeholder="Contoh: R-602"
                                   class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5">
                            @error('room_number') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tipe Kamar --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Tipe Kamar</label>
                            <select name="room_type_id" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 dark:bg-zinc-800 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5">
                                <option value="" disabled selected class="text-gray-400">Pilih Tipe Kamar</option>
                                @foreach ($roomTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('room_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('room_type_id') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Status Awal Kamar --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Status Operasional Awal</label>
                        <select name="status" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 dark:bg-zinc-800 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5">
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                    </div>

                    {{-- Unggah Berkas Foto Kamar --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Foto Kamar (Bisa pilih beberapa)</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-gray-200 dark:border-zinc-700 border-dashed rounded-xl cursor-pointer bg-gray-50/30 dark:bg-zinc-800/10 hover:bg-gray-50 dark:hover:bg-zinc-800/30 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-4 pb-4 text-center">
                                    <svg class="w-7 h-7 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-xs text-gray-500 dark:text-zinc-400 font-medium">Klik untuk memilih dokumentasi foto unit kamar</p>
                                    <p class="text-[10px] text-gray-400 dark:text-zinc-500 mt-0.5">Format file yang didukung: JPG, JPEG, PNG</p>
                                </div>
                                <input type="file" name="images[]" multiple accept="image/*" class="hidden" id="roomImagesInput">
                            </label>
                        </div>
                        {{-- Placeholder container untuk menampilkan feedback nama/jumlah file terpilih --}}
                        <div id="fileFeedback" class="text-[11px] text-zinc-400 font-medium italic px-1 hidden"></div>
                        @error('images.*') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="border-t border-gray-100 dark:border-zinc-800/60 pt-4 mt-6"></div>

                    {{-- Grup Tombol Simpan & Batalkan --}}
                    <div class="flex items-center space-x-3 text-xs font-bold uppercase tracking-wider">
                        {{-- Tombol Utama: Kuning Emas, Teks Hitam Pekat --}}
                        <button type="submit" class="bg-[#FACC15] text-zinc-950 px-5 py-2.5 rounded-xl hover:bg-amber-500 transition-colors shadow-sm">
                            Simpan Kamar
                        </button>
                        <a href="{{ route('rooms.index') }}" class="bg-gray-50 dark:bg-zinc-800 text-gray-700 dark:text-zinc-300 border border-gray-200 dark:border-zinc-700 hover:bg-gray-100 dark:hover:bg-zinc-700 px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Penambahan skrip opsional agar user tahu berapa file yang sudah siap diunggah --}}
    <script>
        document.getElementById('roomImagesInput').addEventListener('change', function(e) {
            const feedback = document.getElementById('fileFeedback');
            const fileCount = e.target.files.length;
            if(fileCount > 0) {
                feedback.textContent = `✓ ${fileCount} berkas foto telah dipilih dan siap diunggah.`;
                feedback.classList.remove('hidden');
            } else {
                feedback.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>