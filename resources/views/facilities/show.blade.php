<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Fasilitas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8 text-center">
                
                <div class="w-16 h-16 bg-[#FACC15]/10 dark:bg-[#FACC15]/5 rounded-full flex items-center justify-center mx-auto mb-5 border border-[#FACC15]/20">
                    <svg class="w-8 h-8 text-amber-500 dark:text-[#FACC15]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Informasi Layanan Tambahan</h3>
                    <p class="text-xs text-gray-400 mt-1">Detail tarif resmi untuk fasilitas yang terdaftar pada sistem StayEase.</p>
                </div>

                <div class="space-y-0 border border-gray-100 dark:border-zinc-800 rounded-xl overflow-hidden mb-6 shadow-sm">
                    
                    <div class="flex justify-between items-center px-5 py-4 bg-gray-50/50 dark:bg-zinc-800/20 border-b border-gray-100 dark:border-zinc-800">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Nama Fasilitas</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-zinc-200">{{ $facility->name }}</span>
                    </div>

                    <div class="flex justify-between items-center px-5 py-4 bg-white dark:bg-zinc-900">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Harga Layanan</span>
                        <span class="text-base font-mono font-bold text-amber-600 dark:text-[#FACC15]">
                            Rp {{ number_format($facility->price, 0, ',', '.') }}
                        </span>
                    </div>

                </div>

                <div class="pt-4 border-t border-gray-100 dark:border-zinc-800">
                    <a href="{{ route('facilities.index') }}" 
                       class="inline-block w-full bg-[#FACC15] text-zinc-950 px-6 py-2.5 rounded-xl hover:bg-amber-500 transition-colors text-xs font-bold uppercase tracking-wider shadow-sm text-center">
                        Kembali ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>