<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col justify-center items-center px-4">
        {{-- Card Utama --}}
        <div class="w-full sm:max-w-md bg-white dark:bg-zinc-900 shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 space-y-6">
            
            {{-- Header & Penjelasan --}}
            <div class="space-y-2">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Pemulihan Akun</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                    {{ __('Lupa kata sandi Anda? Tidak masalah. Cukup masukkan alamat email Anda dan kami akan mengirimkan tautan pemulihan untuk mengatur ulang kata sandi baru.') }}
                </p>
            </div>

            <div class="border-t border-gray-100 dark:border-zinc-800/60"></div>

            <!-- Session Status Transparan -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Form Pengiriman Link --}}
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Alamat Email -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Alamat Email')" class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500" />
                    <x-text-input id="email" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-transparent dark:text-zinc-200 focus:border-[#FACC15] focus:ring-[#FACC15] text-sm py-2.5 shadow-none" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="text-red-500 text-xs font-medium mt-1" />
                </div>

                <div class="border-t border-gray-100 dark:border-zinc-800/60 pt-2"></div>

                {{-- Aksi Tombol --}}
                <div class="flex flex-col space-y-3 text-xs font-bold uppercase tracking-wider text-center">
                    <button type="submit" class="w-full bg-[#FACC15] text-zinc-950 py-3 rounded-xl hover:bg-amber-500 transition-colors shadow-sm justify-center inline-flex items-center">
                        {{ __('Kirim Tautan Reset') }}
                    </button>
                    
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-200 transition-colors py-2 font-semibold tracking-normal normal-case text-sm">
                        Kembali ke Halaman Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>