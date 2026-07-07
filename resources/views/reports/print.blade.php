<!DOCTYPE html>
<html>
<head>
    <title>Laporan Reservasi Hotel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; font-size: 13px; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; margin-bottom: 5px; }
        p.subtitle { text-align: center; color: #666; margin-top: 0; }

        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <h2>Laporan Reservasi Hotel</h2>
    <p class="subtitle">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>

    <button class="no-print" onclick="window.print()">Print / Save as PDF</button>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Booking</th>
                <th>Nama Tamu</th>
                <th>No. Kamar</th>
                <th>Tipe Kamar</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $i => $booking)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $booking->booking_code }}</td>
                <td>{{ $booking->guest->name }}</td>
                <td>{{ $booking->room->room_number }}</td>
                <td>{{ $booking->room->roomType->name }}</td>
                <td>{{ $booking->checkin_date->format('d/m/Y') }}</td>
                <td>{{ $booking->checkout_date->format('d/m/Y') }}</td>
                <td>{{ str_replace('_', ' ', ucfirst($booking->status)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>