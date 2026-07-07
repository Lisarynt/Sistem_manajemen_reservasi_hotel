<x-app-layout>
    <x-slot name="header">QR Code Booking</x-slot>
    <x-slot name="subheader">Kode: {{ $booking->booking_code }}</x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl p-8 shadow-sm border border-gray-100 dark:border-zinc-800 text-center">
                
                <div class="inline-block bg-white p-5 rounded-2xl border border-gray-100 shadow-inner mb-4">
                    {!! $qrcode !!}
                </div>

                <div class="space-y-2">
                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        Scan QR untuk Verifikasi
                    </p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 max-w-xs mx-auto leading-relaxed">
                        Tunjukkan kode QR ini kepada resepsionis saat tiba di hotel untuk mempercepat proses check-in.
                    </p>
                </div>

                <div class="mt-4 bg-gray-50 dark:bg-zinc-800/50 p-2.5 rounded-xl border border-gray-100 dark:border-zinc-800/60">
                    <p class="text-[11px] font-mono text-gray-400 dark:text-gray-500 break-all select-all">{{ $verifyUrl }}</p>
                </div>

                <a href="{{ route('bookings.show', $booking) }}"
                   class="inline-block w-full mt-6 bg-[#FACC15] text-zinc-950 px-5 py-2.5 rounded-xl hover:bg-amber-500 transition-colors text-xs font-bold uppercase tracking-wider shadow-sm text-center">
                    Kembali ke Detail
                </a>
            </div>
        </div>
    </div>
</x-app-layout>