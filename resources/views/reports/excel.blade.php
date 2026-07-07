<table border="1">
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