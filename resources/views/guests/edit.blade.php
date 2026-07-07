<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl p-8 border border-gray-100 dark:border-zinc-800">
                
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Ubah Data Tamu</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Perbarui informasi data diri pelanggan dengan teliti.</p>
                </div>

                <form action="{{ route('guests.update', $guest) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-gray-500 dark:text-gray-400 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $guest->name) }}" 
                            class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30 text-sm py-2.5">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-gray-500 dark:text-gray-400 mb-1.5">Email (opsional)</label>
                        <input type="email" name="email" value="{{ old('email', $guest->email) }}" 
                            class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30 text-sm py-2.5" placeholder="nama@email.com">
                        @error('email') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-gray-500 dark:text-gray-400 mb-1.5">No. Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $guest->phone) }}" 
                                class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30 text-sm py-2.5">
                            @error('phone') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-gray-500 dark:text-gray-400 mb-1.5">No. KTP / Paspor</label>
                            <input type="text" name="id_number" value="{{ old('id_number', $guest->id_number) }}" 
                                class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30 text-sm py-2.5">
                            @error('id_number') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-gray-500 dark:text-gray-400 mb-1.5">Alamat (opsional)</label>
                        <textarea name="address" rows="3" 
                            class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30 text-sm py-2.5">{{ old('address', $guest->address) }}</textarea>
                        @error('address') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center space-x-3 pt-4 border-t border-gray-100 dark:border-zinc-800">
                        <button type="submit" class="bg-[#FACC15] text-zinc-950 px-6 py-2.5 rounded-xl font-bold text-xs tracking-wider uppercase hover:bg-amber-500 transition-colors shadow-sm">
                            Simpan Perubahan
                        </button>
                        
                        <a href="{{ route('guests.index') }}" class="bg-white text-gray-700 dark:bg-zinc-800 dark:text-zinc-300 border border-gray-200 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-700/50 px-6 py-2.5 rounded-xl font-bold text-xs tracking-wider uppercase transition-colors shadow-sm text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>