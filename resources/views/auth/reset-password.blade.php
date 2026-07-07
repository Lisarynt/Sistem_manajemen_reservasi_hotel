<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col justify-center items-center px-4">
        {{-- Card Utama --}}
        <div class="w-full sm:max-w-md bg-white dark:bg-zinc-900 shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 space-y-6">
            
            {{-- Header & Keterangan Halaman --}}
            <div class="space-y-2">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Kata Sandi Baru</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                    {{ __('Silakan masukkan alamat email Anda dan buat kata sandi baru yang kuat untuk memperbarui akses akun StayEase Anda.') }}
                </p>
            </div>

            <div class="border-t border-gray-100 dark:border-zinc-800/60"></div>

            {{-- Form Input Data --}}
            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <!-- Password Reset Token (Hidden) -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Alamat Email -->
                <div class="space-y-1.5">
                    <x-input-label for="email" :value="__('Alamat Email')" class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500" />
                    <x-text-input id="email" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5 shadow-none" 
                                  type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="text-red-500 text-xs font-medium mt-1" />
                </div>

                <!-- Kata Sandi Baru -->
                <div class="space-y-1.5">
                    <x-input-label for="password" :value="__('Kata Sandi Baru')" class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500" />
                    <x-text-input id="password" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5 shadow-none" 
                                  type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="text-red-500 text-xs font-medium mt-1" />
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="space-y-1.5">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500" />
                    <x-text-input id="password_confirmation" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5 shadow-none"
                                  type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-500 text-xs font-medium mt-1" />
                </div>

                <div class="border-t border-gray-100 dark:border-zinc-800/60 pt-3 mt-5"></div>

                {{-- Tombol Submit --}}
                <div class="text-xs font-bold uppercase tracking-wider">
                    <button type="submit" class="w-full bg-[#FACC15] text-zinc-950 py-3 rounded-xl hover:bg-amber-500 transition-colors shadow-sm justify-center inline-flex items-center">
                        {{ __('Perbarui Kata Sandi') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>