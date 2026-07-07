<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Jost:wght@400;500;600;700&display=swap');
    </style>

    <div class="relative h-screen grid grid-cols-1 lg:grid-cols-2 bg-[#F8F9FA]" style="font-family:'Inter', sans-serif;">
        <div class="hidden lg:flex relative flex-col justify-between overflow-hidden bg-[#1A1A1A] px-14 py-14">

            <div class="pointer-events-none absolute inset-6 border border-[#FACC15]/20"></div>

            <div class="relative z-10 flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#FACC15] text-[#1A1A1A] font-bold">
                    <span class="text-lg">SE</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-white tracking-wide">MaRe</span>
                    <span class="text-[10px] tracking-wider text-gray-400">Management Reservasi</span>
                </div>
            </div>

            <div class="relative z-10 flex flex-1 items-center justify-center py-10">
                <svg viewBox="0 0 260 320" class="h-full max-h-80 w-auto text-[#FACC15]/40" fill="none" stroke="currentColor" stroke-width="1.2">
                    <path d="M20 300 V140 A110 110 0 0 1 240 140 V300" />
                    <path d="M40 300 V150 A90 90 0 0 1 220 150 V300" />
                    <line x1="130" y1="60" x2="130" y2="300" stroke-width="0.8" opacity="0.6"/>
                    <line x1="20" y1="220" x2="240" y2="220" stroke-width="0.8" opacity="0.6"/>
                    <line x1="20" y1="260" x2="240" y2="260" stroke-width="0.8" opacity="0.6"/>
                </svg>
            </div>

            <div class="relative z-10 mb-10 max-w-sm">
                <p class="text-2xl font-medium text-white leading-snug">
                    Daftarkan akun admin baru untuk mulai mengelola ketersediaan kamar hotel.
                </p>
            </div>

            <div class="relative z-10 border-t border-gray-800 pt-6">
                <p class="text-[11px] tracking-[0.25em] text-gray-500 uppercase">&copy; 2026 MaRe. All rights reserved.</p>
            </div>
        </div>

        <div class="flex items-center justify-center px-6 py-10 sm:px-10 lg:px-16 overflow-y-auto">
            <div class="w-full max-w-md my-auto">

                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-[#1A1A1A]">Buat Akun Baru</h1>
                    <p class="mt-2 text-[15px] text-gray-500">
                        Isi formulir di bawah ini untuk mendaftarkan hak akses admin.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Name')" class="text-[11px] font-bold tracking-[0.1em] uppercase text-gray-700" />
                        <x-text-input id="name" 
                            class="block mt-1.5 w-full rounded-md border-gray-300 bg-white text-[#1A1A1A] placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required autofocus autocomplete="name" 
                            placeholder="Nama Lengkap" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-[11px] font-bold tracking-[0.1em] uppercase text-gray-700" />
                        <x-text-input id="email" 
                            class="block mt-1.5 w-full rounded-md border-gray-300 bg-white text-[#1A1A1A] placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required autocomplete="username" 
                            placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-[11px] font-bold tracking-[0.1em] uppercase text-gray-700" />
                        <x-text-input id="password" 
                            class="block mt-1.5 w-full rounded-md border-gray-300 bg-white text-[#1A1A1A] placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[11px] font-bold tracking-[0.1em] uppercase text-gray-700" />
                        <x-text-input id="password_confirmation" 
                            class="block mt-1.5 w-full rounded-md border-gray-300 bg-white text-[#1A1A1A] placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30"
                            type="password"
                            name="password_confirmation" 
                            required autocomplete="new-password" 
                            placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a class="text-xs text-gray-500 underline decoration-gray-300 underline-offset-4 hover:text-[#1A1A1A] rounded-md focus:outline-none" 
                            href="{{ route('login') }}">
                            {{ __('Already registered? Log in') }}
                        </a>

                        <x-primary-button class="!bg-[#1A1A1A] !text-white hover:!bg-[#FACC15] hover:!text-[#1A1A1A] !tracking-[0.1em] !uppercase !text-xs !font-bold !rounded-lg !px-6 !py-3 focus:!ring-[#FACC15]/60 transition-colors border border-transparent hover:border-[#1A1A1A]">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

                <p class="mt-8 text-center text-xs tracking-[0.1em] uppercase text-gray-400">
                    MaRe &middot; Dashboard System Register
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>