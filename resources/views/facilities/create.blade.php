<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Fasilitas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8">
                
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Fasilitas Baru</h3>
                    <p class="text-xs text-gray-400 mt-1">Tambahkan layanan atau fasilitas tambahan baru yang dapat ditawarkan kepada tamu hotel.</p>
                </div>

                <form action="{{ route('facilities.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Nama Fasilitas</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                            class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm"
                            placeholder="Contoh: Breakfast, Extra Bed, Spa">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Harga Layanan (Rp)</label>
                        <input type="number" name="price" value="{{ old('price') }}" 
                            class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm"
                            placeholder="0">
                        @error('price') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-zinc-800">
                        <button type="submit" class="bg-[#FACC15] text-zinc-950 px-6 py-2.5 rounded-xl hover:bg-amber-500 transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                            Simpan Fasilitas
                        </button>
                        
                        <a href="{{ route('facilities.index') }}" class="bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 px-6 py-2.5 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>