<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Carcare</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: #007BFF;
            text-align: center;
        }
        .booking-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .booking-table th,
        .booking-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .booking-table th {
            background-color: #007BFF;
            color: #fff;
        }
        .booking-table tr:hover {
            background-color: #f1f1f1;
        }
        .status {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: bold;
        }
        .status.pending {
            background-color: #ffcc00;
            color: #000;
        }
        .status.confirmed {
            background-color: #28a745;
            color: #fff;
        }
        .status.completed {
            background-color: #17a2b8;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Bookings</h1>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->service->name }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->booking_time }}</td>
                        <td>
                            <span class="status {{ $booking->status }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #777;">
                            No bookings found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>