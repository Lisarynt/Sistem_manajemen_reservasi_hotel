<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col justify-center items-center px-4">
        {{-- Card Utama --}}
        <div class="w-full sm:max-w-md bg-white dark:bg-zinc-900 shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 space-y-6">
            
            {{-- Header & Penjelasan Keamanan --}}
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 text-amber-500 bg-amber-500/10 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m0 0v2m0-2h2m-2 0H10m3-13a4 4 0 014 4v2m0 0a3 3 0 013 3v7a3 3 0 01-3 3H6a3 3 0 01-3-3v-7a3 3 0 013-3m10 0V4a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Area Amankan
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">Konfirmasi Sandi</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                    {{ __('Ini adalah area aman aplikasi. Silakan konfirmasikan kata sandi Anda sebelum melanjutkan akses.') }}
                </p>
            </div>

            <div class="border-t border-gray-100 dark:border-zinc-800/60"></div>

            {{-- Form Konfirmasi --}}
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                <!-- Input Password -->
                <div class="space-y-2">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500" />
                    <x-text-input id="password" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5 shadow-none"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="text-red-500 text-xs font-medium mt-1" />
                </div>

                <div class="border-t border-gray-100 dark:border-zinc-800/60 pt-2"></div>

                {{-- Tombol Aksi --}}
                <div class="text-xs font-bold uppercase tracking-wider">
                    <button type="submit" class="w-full bg-[#FACC15] text-zinc-950 py-3 rounded-xl hover:bg-amber-500 transition-colors shadow-sm justify-center inline-flex items-center">
                        {{ __('Konfirmasi Akses') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>