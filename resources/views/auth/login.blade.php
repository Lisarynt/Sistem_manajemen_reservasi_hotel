<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Jost:wght@400;500;600;700&display=swap');
    </style>

    <div class="relative h-screen grid grid-cols-1 lg:grid-cols-2 bg-[#F8F9FA]" style="font-family:'Inter', sans-serif;">
        {{-- LEFT PANEL — Mengikuti identitas Dashboard MaRe --}}
        <div class="hidden lg:flex relative flex-col justify-between overflow-hidden bg-[#1A1A1A] px-14 py-14">

            {{-- Border Kuning Tipis Elegan --}}
            <div class="pointer-events-none absolute inset-6 border border-[#FACC15]/20"></div>

            {{-- Logo / Monogram --}}
            <div class="relative z-10 flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#FACC15] text-[#1A1A1A] font-bold">
                    <span class="text-lg">SE</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-white tracking-wide">MaRe</span>
                    <span class="text-[10px] tracking-wider text-gray-400">Management Reservasi</span>
                </div>
            </div>

            {{-- Arched Window Motif disesuaikan warnanya --}}
            <div class="relative z-10 flex flex-1 items-center justify-center py-10">
                <svg viewBox="0 0 260 320" class="h-full max-h-80 w-auto text-[#FACC15]/40" fill="none" stroke="currentColor" stroke-width="1.2">
                    <path d="M20 300 V140 A110 110 0 0 1 240 140 V300" />
                    <path d="M40 300 V150 A90 90 0 0 1 220 150 V300" />
                    <line x1="130" y1="60" x2="130" y2="300" stroke-width="0.8" opacity="0.6"/>
                    <line x1="20" y1="220" x2="240" y2="220" stroke-width="0.8" opacity="0.6"/>
                    <line x1="20" y1="260" x2="240" y2="260" stroke-width="0.8" opacity="0.6"/>
                </svg>
            </div>

            {{-- Tagline --}}
            <div class="relative z-10 mb-10 max-w-sm">
                <p class="text-2xl font-medium text-white leading-snug">
                    Kelola ketersediaan kamar dan reservasi tamu dalam satu dashboard terintegrasi.
                </p>
            </div>

            {{-- Hak Cipta / Footer Kiri --}}
            <div class="relative z-10 border-t border-gray-800 pt-6">
                <p class="text-[11px] tracking-[0.25em] text-gray-500 uppercase">&copy; 2026 MaRe. All rights reserved.</p>
            </div>
        </div>

        {{-- RIGHT PANEL — Form Login --}}
        <div class="flex items-center justify-center px-6 py-14 sm:px-10 lg:px-16">
            <div class="w-full max-w-md">

                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-[#1A1A1A]">Selamat Datang Kembali</h1>
                    <p class="mt-2 text-[15px] text-gray-500">
                        Silakan masuk untuk mengakses panel administrasi hotel.
                    </p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4 rounded-md border border-[#FACC15]/40 bg-[#FACC15]/10 px-4 py-3 text-sm text-[#1A1A1A]" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email Address --}}
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-[11px] font-bold tracking-[0.1em] uppercase text-gray-700" />
                        <x-text-input id="email"
                            class="block mt-2 w-full rounded-md border-gray-300 bg-white text-[#1A1A1A] placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus autocomplete="username"
                            placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-[11px] font-bold tracking-[0.1em] uppercase text-gray-700" />

                        <x-text-input id="password"
                            class="block mt-2 w-full rounded-md border-gray-300 bg-white text-[#1A1A1A] placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember Me --}}
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-[#1A1A1A] shadow-sm focus:ring-[#FACC15]/40"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    {{-- Fitur Link & Tombol --}}
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex flex-col space-y-1">
                            @if (Route::has('password.request'))
                                <a class="text-xs text-gray-500 underline decoration-gray-300 underline-offset-4 hover:text-[#1A1A1A] rounded-md focus:outline-none"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                            
                            {{-- Tambahan Link Registrasi ke register.blade.php --}}
                            <a class="text-xs text-gray-500 underline decoration-gray-300 underline-offset-4 hover:text-[#1A1A1A] rounded-md focus:outline-none"
                                href="{{ route('register') }}">
                                Belum punya akun? Daftar disini
                            </a>
                        </div>

                        {{-- Tombol Login Warna Hitam & Kuning seperti Dashboard --}}
                        <x-primary-button class="!bg-[#1A1A1A] !text-white hover:!bg-[#FACC15] hover:!text-[#1A1A1A] !tracking-[0.1em] !uppercase !text-xs !font-bold !rounded-lg !px-6 !py-3 focus:!ring-[#FACC15]/60 transition-colors border border-transparent hover:border-[#1A1A1A]">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>

                <p class="mt-10 text-center text-xs tracking-[0.1em] uppercase text-gray-400">
                    MaRe &middot; Dashboard System Login
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>