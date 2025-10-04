<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        .container {
            background: #fff;
            padding: 20px 30px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #2c3e50;
        }

        p {
            margin: 10px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.95em;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>New Booking Notification</h2>

        <p>Dear <strong>Concern</strong>,</p>

        <p>
            This is to inform you that a new <strong>{{ $booking->event->name }}</strong> booking has been created.
        </p>
        <a href="{{route('booking.qr', encrypt($booking->id))}}" style="font-weight: 900; text-decoration: none; color:#fff;background-color: #632ce3">Print QR Code</a>

        <p>
            @foreach (json_decode($booking->form_data, true) as $key => $value)
                <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                {{ is_array($value) ? implode(', ', $value) : $value }}<br>
            @endforeach
        </p>

        @if ($booking->event && $booking->event_plan)
            <p>
                <strong>Event:</strong> {{ $booking->event->name }}<br>
                <strong>Time Slot:</strong>
                {{ \Carbon\Carbon::parse($booking->event_plan->date . ' ' . $booking->event_plan->time)->format('l, F j, Y - h:i A') }}
            </p>
        @endif

        <p>
            <strong>Total Persons:</strong> {{ $booking->total_person }}<br>
            <strong>Total Cars:</strong> {{ $booking->total_car }}<br>
            <strong>Transaction ID:</strong> {{ $booking->txn_id }}
        </p>

        <p>Thank you.</p>

        <p class="footer"><strong>{{ $siteData['site_name'] }}</strong></p>
    </div>
</body>

</html>
