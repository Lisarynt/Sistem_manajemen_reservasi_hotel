<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 border border-gray-100 dark:border-zinc-800 text-center flex flex-col items-center justify-between shadow-sm">
                    <div class="w-full">
                        <div class="w-20 h-20 bg-zinc-900 dark:bg-zinc-800 text-[#FACC15] rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-sm border border-zinc-800 dark:border-zinc-700">
                        </div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white truncate">{{ $guest->name }}</h3>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mt-1">ID: {{ $guest->id_number }}</p>
                        
                        <div class="border-t border-gray-100 dark:border-zinc-800 my-4"></div>
                        
                        <p class="text-xs text-gray-500 dark:text-zinc-400 italic">
                            "{{ $guest->address ?? 'Alamat belum diisi' }}"
                        </p>
                    </div>

                    <a href="{{ route('guests.index') }}" class="w-full mt-6 inline-block bg-white dark:bg-zinc-800 text-gray-700 dark:text-zinc-300 border border-gray-200 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-700/50 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors text-center shadow-sm">
                        &larr; Kembali ke Daftar
                    </a>
                </div>

                <div class="md:col-span-2 bg-white dark:bg-zinc-900 rounded-2xl p-8 border border-gray-100 dark:border-zinc-800 shadow-sm space-y-6">
                    
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-4">Informasi Kontak & Identitas</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-gray-50 dark:bg-zinc-800/40 p-3.5 rounded-xl border border-gray-100 dark:border-zinc-800/60">
                                <span class="block text-[10px] text-gray-400 dark:text-zinc-500 font-bold uppercase tracking-wider">No. HP / Telepon</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-zinc-200">{{ $guest->phone }}</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-zinc-800/40 p-3.5 rounded-xl border border-gray-100 dark:border-zinc-800/60">
                                <span class="block text-[10px] text-gray-400 dark:text-zinc-500 font-bold uppercase tracking-wider">Alamat Email</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-zinc-200">{{ $guest->email ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-3">Riwayat Booking / Reservasi</h4>
                        <div class="space-y-3">
                            @forelse ($guest->bookings as $booking)
                                <div class="flex items-center justify-between bg-white dark:bg-zinc-800/20 p-4 rounded-xl border border-gray-100 dark:border-zinc-800/50 shadow-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-gray-100 dark:bg-zinc-800 rounded-lg text-gray-600 dark:text-zinc-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-bold text-gray-900 dark:text-white">{{ $booking->booking_code }}</span>
                                            <span class="text-xs text-gray-400 dark:text-zinc-500">Kamar {{ $booking->room->room_number }}</span>
                                        </div>
                                    </div>
                                    
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                        {{ $booking->status === 'completed' || $booking->status === 'confirmed' 
                                            ? 'bg-green-50 text-green-700 dark:bg-green-950/30 dark:text-green-400' 
                                            : 'bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-amber-400' }}">
                                        {{ str_replace('_', ' ', $booking->status) }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-8 bg-gray-50/50 dark:bg-zinc-800/10 border border-dashed border-gray-200 dark:border-zinc-800 rounded-xl">
                                    <p class="text-xs text-gray-400 dark:text-zinc-500 italic">Belum ada riwayat transaksi reservasi.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>