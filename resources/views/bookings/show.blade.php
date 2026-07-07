<x-app-layout>
    <x-slot name="header">Detail Booking</x-slot>
    <x-slot name="subheader">Kode: {{ $booking->booking_code }}</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 p-8 space-y-5">

                <!-- Baris Status -->
                <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-zinc-800/60">
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

                <!-- Baris Tamu -->
                <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-zinc-800/60">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Tamu</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $booking->guest->name }}</span>
                </div>

                <!-- Baris Kamar -->
                <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-zinc-800/60">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Kamar</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $booking->room->room_number }} <span class="text-xs font-normal text-gray-400 dark:text-gray-500">({{ $booking->room->roomType->name }})</span></span>
                </div>

                <!-- Baris Check-In -->
                <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-zinc-800/60">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Check-In</span>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $booking->checkin_date->format('d/m/Y') }}</span>
                </div>

                <!-- Baris Check-Out -->
                <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-zinc-800/60">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Check-Out</span>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $booking->checkout_date->format('d/m/Y') }}</span>
                </div>

                @if ($booking->actual_checkin_at)
                    <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-zinc-800/60">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Waktu Check-In Aktual</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $booking->actual_checkin_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif

                @if ($booking->actual_checkout_at)
                    <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-zinc-800/60">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Waktu Check-Out Aktual</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $booking->actual_checkout_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif

                <!-- Blok Fasilitas Tambahan -->
                <div class="pt-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2.5">Fasilitas Tambahan</h4>
                    <div class="bg-gray-50 dark:bg-zinc-800/50 p-4 rounded-xl border border-gray-100 dark:border-zinc-800/60 space-y-1.5">
                        @forelse ($booking->facilities as $facility)
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 flex justify-between">
                                <span>• {{ $facility->name }}</span>
                                <span class="font-mono text-xs text-gray-500 dark:text-gray-400">Rp {{ number_format($facility->price, 0, ',', '.') }}</span>
                            </p>
                        @empty
                            <p class="text-sm text-gray-400 dark:text-gray-500 italic">Tidak ada fasilitas tambahan.</p>
                        @endforelse
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">Riwayat Pembayaran</h4>

                @php
                    $totalPaid = $booking->payments->where('status', 'paid')->sum('amount');
                @endphp

                @forelse ($booking->payments as $payment)
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <div>
                            <p class="text-sm text-gray-900 dark:text-gray-200">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">{{ ucfirst($payment->method) }} &middot; {{ $payment->paid_at?->format('d/m/Y H:i') }}</p>
                        </div>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Hapus catatan pembayaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs hover:underline">Hapus</button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">Belum ada pembayaran tercatat.</p>
                @endforelse

                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mt-3">
                    Total Terbayar: Rp {{ number_format($totalPaid, 0, ',', '.') }}
                </p>

                <form action="{{ route('payments.store', $booking) }}" method="POST" class="mt-4 flex flex-wrap gap-2 items-end">
                    @csrf
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Jumlah Bayar</label>
                        <input type="number" name="amount" required min="0"
                            class="rounded-lg border-gray-300 text-sm dark:bg-gray-700 dark:text-white focus:ring-[#eab308] focus:border-[#eab308]">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Metode</label>
                        <select name="method" class="rounded-lg border-gray-300 text-sm dark:bg-gray-700 dark:text-white focus:ring-[#eab308] focus:border-[#eab308]">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="debit">Debit</option>
                            <option value="credit">Credit</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-[#18181b] text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition">
                        Catat Pembayaran
                    </button>
                </form>
            </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-zinc-800">
                    <a href="{{ route('bookings.qrcode', $booking) }}" target="_blank"
                       class="bg-[#FACC15] text-zinc-950 px-6 py-2.5 rounded-xl hover:bg-amber-500 transition-colors text-xs font-bold uppercase tracking-wider shadow-sm text-center">
                        Lihat QR Code
                    </a>
                    
                    <a href="{{ route('bookings.index') }}"
                       class="bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 px-6 py-2.5 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm text-center">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>