
<div class="container">
    <h1>Booking List</h1>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add Booking</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Service</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->customer_name }}</td>
                    <td>{{ $booking->service }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ $booking->booking_time }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

