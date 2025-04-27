<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Shop - Emergency Bookings Status</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    .dashboard-wrapper {
      display: flex;
      min-height: 100vh;
      margin-top: 20px;
    }

    .sidebar-wrapper {
      width: 260px;
      background-color: #fff;
    }

    .content-wrapper {
      flex: 1;
      padding: 30px;
      margin-left: 40px;
      margin-top: 75px;
    }

    .container {
      max-width: 1400px;
    }

    .page-title {
      font-size: 28px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .page-description {
      color: #666;
      font-size: 16px;
      margin-bottom: 30px;
    }

    .back-to-map {
      margin-bottom: 25px;
    }

    .back-to-map a {
      padding: 10px 20px;
      border-radius: 50px;
    }

    .table-container {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      padding: 20px;
    }

    .table th {
      background-color: #007bff;
      color: #fff;
      text-transform: uppercase;
    }

    .table td {
      vertical-align: middle !important;
    }

    .btn-complete {
      background-color: #28a745;
      color: #fff;
      border-radius: 50px;
      font-size: 14px;
      padding: 6px 14px;
      transition: 0.3s ease;
    }

    .btn-complete:hover {
      background-color: #218838;
    }

    .btn-completed {
      background-color: #6c757d;
      color: #fff;
      border-radius: 50px;
      font-size: 14px;
      padding: 6px 14px;
      cursor: not-allowed;
    }

    .badge {
      font-size: 13px;
      padding: 8px 14px;
      border-radius: 50px;
      text-transform: capitalize;
    }

    .alert-info {
      background-color: #e9f7ff;
      border-color: #bee5eb;
      color: #31708f;
      border-radius: 12px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .content-wrapper {
        margin-left: 0 !important;
        padding: 15px;
      }

      .back-to-map {
        margin-bottom: 20px;
      }
    }

    /* Hover effect on rows */
    .clickable-row:hover {
      background-color: #f1f1f1;
      cursor: pointer;
    }
    .review-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: linear-gradient(135deg, #3b82f6, #10b981);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 14px;
  flex-shrink: 0;
}
  </style>
</head>

<body>

  <div class="dashboard-wrapper">

    <!-- Sidebar -->
    <div class="sidebar-wrapper">
      <x-sidebar />
    </div>

    <!-- Main Content -->
    <div class="content-wrapper">
      <div class="container">

        <!-- Page Title -->
        <div class="text-center mb-4">
          <h1 class="page-title"><i class="fas fa-tools"></i> Accepted Emergency Bookings</h1>
          <p class="page-description">Manage your current emergency bookings efficiently.</p>
        </div>

        <!-- Back to Map View Button -->
        <div class="text-center back-to-map">
          <a href="{{ route('mechanic-emergency-booking') }}" class="btn btn-primary">
            <i class="fas fa-map-marker-alt"></i> View Map
          </a>
        </div>

        <!-- Bookings Table -->
        <!-- Bookings Table -->
<!-- Bookings Table -->
@if($bookings->count() > 0)
  <div class="table-container mb-5">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Status</th>
            <th>Date Accepted</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bookings as $index => $booking)
            <tr class="clickable-row" data-url="{{ route('emergency-bookings.show', $booking->id) }}">
              <td>
                <span class="badge badge-primary">
                  <i class="fas fa-car-crash me-1"></i>EMB{{ $booking->id }}
                </span>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="review-avatar mr-2">
                    {{ strtoupper(substr($booking->user->first_name ?? 'N', 0, 1)) }}
                  </div>
                  {{ $booking->user->first_name ?? 'N/A' }} {{ $booking->user->last_name ?? '' }}
                </div>
              </td>
              <td>{{ $booking->emergency_address }}</td>
              <td>
                @if($booking->status === 'accepted')
                  <span class="badge badge-success">Accepted</span>
                @elseif($booking->status === 'completed')
                  <span class="badge badge-info">Completed</span>
                @else
                  <span class="badge badge-warning">{{ ucfirst($booking->status) }}</span>
                @endif
              </td>
              <td>{{ \Carbon\Carbon::parse($booking->updated_at)->format('M d, Y H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@else
  <div class="alert alert-info text-center">
    <i class="fas fa-info-circle"></i> No accepted emergency bookings at the moment.
  </div>
@endif
      </div> <!-- /.container -->
    </div> <!-- /.content-wrapper -->

  </div> <!-- /.dashboard-wrapper -->

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function () {

      // Handle row click except on button
      $('.clickable-row').on('click', function (e) {
        if (!$(e.target).closest('button').length) {
          const url = $(this).data('url');
          window.location = url;
        }
      });

      // Handle Complete button
      $('.complete-btn').on('click', function (e) {
        e.stopPropagation(); // Prevent row click
        const bookingId = $(this).data('id');

        Swal.fire({
          title: 'Complete this booking?',
          text: 'Are you sure you want to mark this booking as completed?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, complete it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            completeBooking(bookingId);
          }
        });
      });

      function completeBooking(bookingId) {
        $.ajax({
          url: `/emergency-booking/${bookingId}/complete`,
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            Swal.fire({
              icon: 'success',
              title: 'Completed!',
              text: response.message,
              timer: 1500,
              showConfirmButton: false
            });

            setTimeout(() => {
              location.reload();
            }, 1500);
          },
          error: function (xhr) {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: xhr.responseJSON?.message || 'Something went wrong!'
            });
          }
        });
      }

    });
  </script>

  <script src="{{ asset('assets/js/script2.js') }}"></script>

</body>

</html>