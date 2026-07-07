<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Booking - StayEase</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-zinc-50 dark:bg-zinc-950 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 overflow-hidden">

        <div class="bg-[#FACC15] px-6 py-6 text-center shadow-sm">
            <div class="w-12 h-12 bg-zinc-950 rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                <svg class="w-6 h-6 text-[#FACC15]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="text-lg font-bold text-zinc-950 uppercase tracking-wider">Booking Terverifikasi</h1>
            <p class="text-xs font-mono font-bold text-zinc-800 mt-0.5 bg-white/40 inline-block px-2.5 py-0.5 rounded-md">{{ $booking->booking_code }}</p>
        </div>

        {{-- Detail Informasi --}}
        <div class="p-6 space-y-4">
            
            <div class="flex justify-between items-center py-2.5 border-b border-gray-100 dark:border-zinc-800/60">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Status</span>
                <span class="text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wide
                    @if($booking->status === 'checked_in') bg-green-50 text-green-700 dark:bg-green-950/30 dark:text-green-400
                    @elseif($booking->status === 'pending') bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-[#FACC15]
                    @elseif($booking->status === 'confirmed') bg-blue-50 text-blue-700 dark:bg-blue-950/30 dark:text-blue-400
                    @elseif($booking->status === 'checked_out') bg-gray-100 text-gray-600 dark:bg-zinc-800 dark:text-gray-400
                    @else bg-red-50 text-red-700 dark:bg-red-950/30 dark:text-red-400 @endif">
                    {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                </span>
            </div>

            <div class="flex justify-between items-center py-2.5 border-b border-gray-100 dark:border-zinc-800/60">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Nama Tamu</span>
                <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $booking->guest->name }}</span>
            </div>

            <div class="flex justify-between items-center py-2.5 border-b border-gray-100 dark:border-zinc-800/60">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Kamar</span>
                <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $booking->room->room_number }} <span class="text-xs font-normal text-gray-400 dark:text-gray-500">({{ $booking->room->roomType->name }})</span></span>
            </div>

            <div class="flex justify-between items-center py-2.5 border-b border-gray-100 dark:border-zinc-800/60">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Check-In</span>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $booking->checkin_date->format('d/m/Y') }}</span>
            </div>

            <div class="flex justify-between items-center py-2.5">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Check-Out</span>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $booking->checkout_date->format('d/m/Y') }}</span>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-zinc-800/30 px-6 py-4 text-center border-t border-gray-100 dark:border-zinc-800/60">
            <p class="text-xs text-gray-400 dark:text-gray-500">Tunjukkan halaman resmi ini ke resepsionis untuk memperbarui status kedatangan Anda.</p>
        </div>
    </div>

</body>
</html>