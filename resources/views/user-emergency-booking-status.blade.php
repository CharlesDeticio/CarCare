<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Emergency Bookings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">


  <!-- Bootstrap CSS -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">


  <style>
    body {
      background-color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
    }

    .page-header {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 40px 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      text-align: center;
      margin: 40px 0 20px;
    }

    .page-header h2 {
      font-weight: 600;
      font-size: 32px;
      margin-bottom: 10px;
      color: #333;
    }

    .page-header p {
      color: #666;
      font-size: 16px;
    }

    .bookings-table {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }

    .table {
      margin-bottom: 0;
    }

    .table thead {
      background-color: #007bff;
      color: #fff;
      text-transform: uppercase;
    }

    .table th,
    .table td {
      vertical-align: middle;
      font-size: 14px;
      padding: 15px;
    }

    .badge-status {
      padding: 8px 16px;
      border-radius: 50px;
      font-size: 12px;
      font-weight: 500;
      text-transform: capitalize;
    }

    .badge-pending {
      background-color: #ffc107;
      color: #212529;
    }

    .badge-accepted {
      background-color: #28a745;
      color: #fff;
    }

    .badge-completed {
      background-color: #007bff;
      color: #fff;
    }

    .badge-other {
      background-color: #6c757d;
      color: #fff;
    }

    .empty-state {
      text-align: center;
      margin-top: 80px;
      color: #666;
    }

    .empty-state i {
      font-size: 80px;
      color: #dee2e6;
      margin-bottom: 20px;
    }

    .empty-state h4 {
      font-weight: 600;
      color: #333;
    }

    .btn-book-now {
      background-color: #dc3545;
      color: #fff;
      border-radius: 50px;
      padding: 10px 30px;
      font-weight: 500;
      transition: 0.3s ease;
    }

    .btn-book-now:hover {
      background-color: #bd2130;
      color: #fff;
    }
  </style>
</head>

<body>

    <x-usersidebar />


  <div class="container">

    <!-- Header -->
    <div class="page-header" style="margin-top: 100px">
      <h2><i class="fas fa-ambulance"></i> My Emergency Bookings</h2>
      <p>Track and manage all your emergency service requests in one place.</p>
    </div>

    <!-- Bookings Table -->
    <!-- Bookings Table -->
@if ($bookings->count())
  <div class="bookings-table mb-5">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Address</th>
            <th>Status</th>
            <th>Shop</th>
            <th>Date Requested</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $index => $booking)
            <tr onclick="window.location='{{ route('user-emergency-bookings.show', $booking->id) }}'" style="cursor:pointer;">
              <td>
                <span class="badge badge-primary">
                  <i class="fas fa-car-crash me-1"></i>EMB{{ $booking->id }}
                </span>
              </td>
              <td>{{ $booking->emergency_address }}</td>
              <td>
                @if ($booking->status === 'pending')
                  <span class="badge-status badge-pending">Pending</span>
                @elseif ($booking->status === 'accepted')
                  <span class="badge-status badge-accepted">Accepted</span>
                @elseif ($booking->status === 'completed')
                  <span class="badge-status badge-completed">Completed</span>
                @else
                  <span class="badge-status badge-other">{{ ucfirst($booking->status) }}</span>
                @endif
              </td>
              <td>
                @if ($booking->mechanic)
                  {{ $booking->mechanic->shopname ?? 'Mechanic #' . $booking->mechanic->id }}
                @else
                  <em>Not assigned</em>
                @endif
              </td>
              <td>{{ $booking->created_at->format('M d, Y h:i A') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@else
  <!-- Empty State -->
  <div class="empty-state">
    <i class="fas fa-calendar-times"></i>
    <h4>No Emergency Bookings Found!</h4>
    <p>Looks like you haven't made any emergency bookings yet.</p>
    <a href="{{ route('user-emergency-booking') }}" class="btn btn-book-now mt-3">
      <i class="fas fa-ambulance"></i> Book Now
    </a>
  </div>
@endif

  </div>

  <!-- Bootstrap JS -->
  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script>

  <!-- Optional custom JS file -->
  <script src="{{ asset('assets/js/script1.js') }}"></script>

</body>
</html>
