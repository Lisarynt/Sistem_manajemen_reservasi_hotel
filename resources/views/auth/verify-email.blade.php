<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col justify-center items-center px-4">
        {{-- Card Utama --}}
        <div class="w-full sm:max-w-md bg-white dark:bg-zinc-900 shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 space-y-6">
            
            {{-- Header & Ilustrasi Mini --}}
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 text-[#FACC15] bg-amber-500/10 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.22 0l-2.25 1.5"/>
                    </svg>
                    Verifikasi Akun
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">Konfirmasi Email Anda</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                    {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerimanya, kami akan dengan senang hati mengirimkan tautan baru.') }}
                </p>
            </div>

            {{-- Notifikasi Tautan Terkirim --}}
            @if (session('status') == 'verification-link-sent')
                <div class="p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-900 text-green-800 dark:text-green-400 rounded-xl text-xs font-medium leading-relaxed shadow-sm">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                </div>
            @endif

            <div class="border-t border-gray-100 dark:border-zinc-800/60 pt-2"></div>

            {{-- Grid Kontrol Form Aksi --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-xs font-bold uppercase tracking-wider">
                
                {{-- Form Kirim Ulang Email --}}
                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto bg-[#FACC15] text-zinc-950 px-5 py-3 rounded-xl hover:bg-amber-500 transition-colors shadow-sm inline-flex items-center justify-center">
                        {{ __('Kirim Ulang Email') }}
                    </button>
                </form>

                {{-- Form Keluar Sistem (Logout) --}}
                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center sm:text-right">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto text-sm font-semibold text-gray-400 hover:text-gray-600 dark:hover:text-zinc-200 transition-colors py-2 tracking-normal normal-case">
                        {{ __('Keluar Aplikasi') }}
                    </button>
                </form>
                
            </div>
        </div>
    </div>
</x-guest-layout>