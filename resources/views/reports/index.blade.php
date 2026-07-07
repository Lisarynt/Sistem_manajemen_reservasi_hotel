<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Laporan Reservasi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold dark:text-white">Data Laporan Reservasi</h3>
                    <div class="space-x-2">
                        <a href="{{ route('reports.excel') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Export Excel
                        </a>
                        <a href="{{ route('reports.print') }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Export PDF / Print
                        </a>
                    </div>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b dark:border-gray-600">
                            <th class="py-2 dark:text-gray-200">Kode</th>
                            <th class="py-2 dark:text-gray-200">Tamu</th>
                            <th class="py-2 dark:text-gray-200">Kamar</th>
                            <th class="py-2 dark:text-gray-200">Check-In</th>
                            <th class="py-2 dark:text-gray-200">Check-Out</th>
                            <th class="py-2 dark:text-gray-200">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2 dark:text-gray-300">{{ $booking->booking_code }}</td>
                                <td class="py-2 dark:text-gray-300">{{ $booking->guest->name }}</td>
                                <td class="py-2 dark:text-gray-300">{{ $booking->room->room_number }}</td>
                                <td class="py-2 dark:text-gray-300">{{ $booking->checkin_date->format('d/m/Y') }}</td>
                                <td class="py-2 dark:text-gray-300">{{ $booking->checkout_date->format('d/m/Y') }}</td>
                                <td class="py-2 dark:text-gray-300">{{ str_replace('_', ' ', ucfirst($booking->status)) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>