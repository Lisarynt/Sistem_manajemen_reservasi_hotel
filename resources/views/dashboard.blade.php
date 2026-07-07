<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>
    <x-slot name="subheader">Selamat datang kembali, {{ auth()->user()->name }}!</x-slot>

    <div class="space-y-6">

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-11 h-11 rounded-xl bg-[#facc15]/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#a16207]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Reservasi</p>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalBookings }}</p>
            </div>

            <div class="bg-[#18181b] rounded-2xl p-5 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-11 h-11 rounded-xl bg-[#facc15]/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#facc15]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" /></svg>
                    </div>
                    <p class="text-sm text-gray-400">Kamar Terisi</p>
                </div>
                <p class="text-2xl font-bold text-white">{{ $roomStatus->get('occupied', 0) }} / {{ $totalRooms }}</p>
                <p class="text-xs text-[#facc15] mt-1">{{ $occupancyRate }}% dari total kamar</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-11 h-11 rounded-xl bg-[#facc15]/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#a16207]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" /></svg>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Tamu</p>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalGuests }}</p>
            </div>

            <div class="bg-[#facc15] rounded-2xl p-5 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-11 h-11 rounded-xl bg-[#18181b]/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#18181b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" /></svg>
                    </div>
                    <p class="text-sm text-[#18181b]/70">Pendapatan</p>
                </div>
                <p class="text-xl font-bold text-[#18181b]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Chart Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-4">Grafik Reservasi (Berdasarkan Tanggal Check-In)</h3>
                <canvas id="bookingTrendChart" height="110"></canvas>
            </div>

            <div class="bg-[#18181b] rounded-2xl p-6 shadow-sm">
                <h3 class="font-semibold text-white mb-4">Status Kamar</h3>
                <div class="flex justify-center">
                    <canvas id="roomStatusChart" height="180"></canvas>
                </div>
                <div class="mt-4 space-y-2">
                    @php
                        $statusColors = ['available' => 'bg-[#facc15]', 'occupied' => 'bg-white', 'maintenance' => 'bg-gray-500'];
                        $statusLabels = ['available' => 'Tersedia', 'occupied' => 'Terisi', 'maintenance' => 'Maintenance'];
                    @endphp
                    @foreach ($roomStatus as $status => $count)
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full {{ $statusColors[$status] ?? 'bg-gray-400' }}"></span>
                                <span class="text-gray-300">{{ $statusLabels[$status] ?? ucfirst($status) }}</span>
                            </div>
                            <span class="font-medium text-white">{{ $count }} ({{ $totalRooms > 0 ? round(($count / $totalRooms) * 100) : 0 }}%)</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Bottom Panels -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">Reservasi Terbaru</h3>
                    <a href="{{ route('bookings.index') }}" class="text-sm text-[#a16207] hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @forelse ($recentBookings as $booking)
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-[#facc15]/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#a16207]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2z" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $booking->booking_code }}</p>
                                <p class="text-xs text-gray-400">{{ $booking->guest->name }} · {{ $booking->room->room_number }}</p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full
                                @if($booking->status === 'checked_in') bg-green-50 text-green-700
                                @elseif($booking->status === 'pending') bg-[#facc15]/20 text-[#a16207]
                                @elseif($booking->status === 'confirmed') bg-gray-900 text-white
                                @else bg-gray-100 text-gray-600 @endif">
                                {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400">Belum ada reservasi.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">Check-in Hari Ini</h3>
                    <a href="{{ route('bookings.index') }}" class="text-sm text-[#a16207] hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @forelse ($todayCheckins as $booking)
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-[#18181b] flex items-center justify-center flex-shrink-0 text-xs font-semibold text-[#facc15]">
                                {{ substr($booking->guest->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $booking->guest->name }}</p>
                                <p class="text-xs text-gray-400">Kamar {{ $booking->room->room_number }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400">Tidak ada check-in hari ini.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-4">Tipe Kamar Terpopuler</h3>
                <canvas id="popularRoomChart" height="150"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('bookingTrendChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($bookingsPerMonth->pluck('month')) !!},
                datasets: [{
                    label: 'Jumlah Booking',
                    data: {!! json_encode($bookingsPerMonth->pluck('total')) !!},
                    borderColor: '#eab308',
                    backgroundColor: 'rgba(234, 179, 8, 0.1)',
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#18181b',
                    pointBorderColor: '#eab308',
                    pointRadius: 4,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        new Chart(document.getElementById('roomStatusChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($roomStatus->keys()) !!},
                datasets: [{
                    data: {!! json_encode($roomStatus->values()) !!},
                    backgroundColor: ['#facc15', '#ffffff', '#52525b'],
                    borderWidth: 0,
                }]
            },
            options: {
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });

        new Chart(document.getElementById('popularRoomChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($popularRoomTypes->pluck('name')) !!},
                datasets: [{
                    label: 'Jumlah Booking',
                    data: {!! json_encode($popularRoomTypes->pluck('total')) !!},
                    backgroundColor: '#eab308',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
    @endpush
</x-app-layout>