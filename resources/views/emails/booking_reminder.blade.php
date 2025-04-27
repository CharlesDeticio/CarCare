<h2>Hi {{ $user->name }},</h2>

<p>This is a reminder that your booking for <strong>{{ $service->name }}</strong> is scheduled for:</p>

<ul>
    <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->toFormattedDateString() }}</li>
    <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</li>
</ul>

<p>Mechanic: {{ $service->mechanic->shopname ?? 'Your assigned mechanic' }}</p>

<p>Thank you for booking with Carcare!</p>
