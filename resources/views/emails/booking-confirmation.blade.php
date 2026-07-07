<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f5; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; }
        .header { background-color: #18181b; padding: 24px; text-align: center; }
        .header h1 { color: #facc15; margin: 0; font-size: 20px; }
        .body { padding: 24px; }
        .row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        .label { color: #71717a; font-size: 13px; }
        .value { color: #18181b; font-size: 13px; font-weight: bold; }
        .footer { background-color: #f4f4f5; padding: 16px; text-align: center; font-size: 12px; color: #71717a; }
        .badge { display: inline-block; background-color: #facc15; color: #18181b; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>StayEase Hotel</h1>
        </div>
        <div class="body">
            <p style="font-size: 15px; color: #18181b;">Halo <strong>{{ $booking->guest->name }}</strong>,</p>
            <p style="font-size: 14px; color: #52525b;">Terima kasih telah melakukan reservasi. Berikut detail booking Anda:</p>

            <p style="text-align: center; margin: 20px 0;">
                <span class="badge">{{ $booking->booking_code }}</span>
            </p>

            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #eee; color: #71717a; font-size: 13px;">Kamar</td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #eee; color: #18181b; font-size: 13px; font-weight: bold; text-align: right;">
                        {{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #eee; color: #71717a; font-size: 13px;">Check-In</td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #eee; color: #18181b; font-size: 13px; font-weight: bold; text-align: right;">
                        {{ $booking->checkin_date->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #eee; color: #71717a; font-size: 13px;">Check-Out</td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #eee; color: #18181b; font-size: 13px; font-weight: bold; text-align: right;">
                        {{ $booking->checkout_date->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #71717a; font-size: 13px;">Status</td>
                    <td style="padding: 8px 0; color: #18181b; font-size: 13px; font-weight: bold; text-align: right;">
                        {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                    </td>
                </tr>
            </table>

            <p style="font-size: 13px; color: #71717a; margin-top: 20px;">
                Mohon tunjukkan kode booking di atas saat check-in di resepsionis.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} StayEase Hotel. All rights reserved.
        </div>
    </div>
</body>
</html>