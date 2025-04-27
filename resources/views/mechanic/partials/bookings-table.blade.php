<div class="card-container mb-5">
    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Service Name</th>
                    <th>Customer</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <!--<th>Status</th>-->
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr class="clickable-row" data-href="{{ route('mechanic.bookings.show', $booking->id) }}">
                    <td>@php
                            // Generate alphanumeric reference
                            $shopInitials = strtoupper(substr($booking->mechanic->shopname ?? 'CAR', 0, 3));
                            $datePart = $booking->created_at->format('Ymd');
                            $randomPart = substr(md5($booking->id), 0, 6);
                            $bookingReference = $shopInitials  . $datePart  . $randomPart;
                        @endphp
                        {{ $bookingReference }}</td>
                    <td>{{ $booking->service->name }}</td>
                    <td>{{ $booking->user->first_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</td>
                    <!--<td>-->
                    <!--    <span class="badge -->
                    <!--        @if($booking->status === 'pending') badge-warning-->
                    <!--        @elseif($booking->status === 'accepted') badge-success-->
                    <!--        @elseif($booking->status === 'declined') badge-danger-->
                    <!--        @elseif($booking->status === 'completed') badge-primary-->
                    <!--        @endif">-->
                    <!--        {{ ucfirst($booking->status) }}-->
                    <!--    </span>-->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No bookings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>