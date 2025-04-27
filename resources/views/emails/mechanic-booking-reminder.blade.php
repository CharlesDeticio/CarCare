<h2>Hello, {{ $mechanic->name }}!</h2>

<p>This is a reminder that you have an upcoming service booking:</p>

<ul>
    <li><strong>Service:</strong> {{ $service->name }}</li>
    <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</li>
    <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</li>
    <li><strong>Customer:</strong> {{ $booking->user->first_name }} {{ $booking->user->last_name }}</li>
</ul>

<p>Please be prepared for this scheduled appointment.</p>

<p>– CarCare Booking System</p>
