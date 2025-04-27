<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <title>Mechanic Booking Dashboard</title>
    
</head>
<body>
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main content -->
    <div class="main-content">
        <div class="container">
            <h1>Mechanic Booking Dashboard</h1>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Service</th>
                            <th>Booking Date</th>
                            <th>Booking Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->service }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->booking_time }}</td>
                                <td>
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="action-button shipped">View</a>
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="action-button pending">Edit</a>
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-button shipped" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
