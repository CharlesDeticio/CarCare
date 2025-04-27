{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}

    <!-- Bootstrap 4 CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> --}}
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css"> --}}
    <!-- Custom CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}"> --}}

    {{-- <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container-bordered {
            background-color: #ffffff;
            padding: 40px 20px;
            border-radius: 12px;
            border: 1px solid #dee2e6;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            max-width: 1100px;
            margin: 100px auto;
        }

        h2 {
            color: #333;
            font-weight: 600;
        }

        /* Booking Tabs Style */
        .booking-tabs {
            display: flex;
            justify-content: center;
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .booking-tabs li {
            list-style: none;
            margin: 0 15px;
        }

        .booking-tabs a {
            display: block;
            padding: 10px 20px;
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .booking-tabs a.active {
            color: #0044ff;
            font-weight: 600;
        }

        .booking-tabs a.active::after {
            content: "";
            display: block;
            height: 3px;
            width: 100%;
            background: #0044ff;
            border-radius: 2px;
            margin-top: 8px;
        }

        .booking-tabs a:hover {
            color: #0044ff;
        }

        /* Card styles */
        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 400px; /* Uniform card height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .border-left-warning { border-left: 5px solid #ffc107 !important; }
        .border-left-success { border-left: 5px solid #28a745 !important; }
        .border-left-danger { border-left: 5px solid #dc3545 !important; }
        .border-left-info { border-left: 5px solid #17a2b8 !important; }

        .btn-cancel {
            background-color: #dc3545;
            border: none;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #bd2130;
        }

        .modal-header {
            background-color: #dc3545;
            color: #fff;
        }

        .modal-footer button {
            min-width: 120px;
        }

        @media (max-width: 576px) {
            .booking-tabs {
                flex-wrap: wrap;
            }
            .booking-tabs li {
                margin: 5px 10px;
            }
        }
    </style>
</head>

<body> --}}

    <!-- User Sidebar -->
    {{-- <x-usersidebar />

    <div class="container container-bordered">
        <h2 class="text-center mb-4"><i class="fas fa-calendar-check"></i> My Bookings</h2> --}}

        <!-- Booking Tabs Navigation -->
        {{-- <ul class="booking-tabs">
            <li><a href="{{ route('user.bookings.index') }}" class="{{ request()->routeIs('user.bookings.index') ? 'active' : '' }}">All</a></li>
            <li><a href="{{ route('user.bookings.pending') }}" class="{{ request()->routeIs('user.bookings.pending') ? 'active' : '' }}">Pending</a></li>
            <li><a href="{{ route('user.bookings.accepted') }}" class="{{ request()->routeIs('user.bookings.accepted') ? 'active' : '' }}">Accepted</a></li>
            <li><a href="{{ route('user.bookings.completed') }}" class="{{ request()->routeIs('user.bookings.completed') ? 'active' : '' }}">Completed</a></li>
            <li><a href="{{ route('user.bookings.cancelled.list') }}" class="{{ request()->routeIs('user.bookings.cancelled.list') ? 'active' : '' }}">Cancelled</a></li>
        </ul> --}}

        <!-- Booking Cards -->
        {{-- <div class="row">
            @if ($bookings->isEmpty())
                <div class="col-12 text-center text-muted py-5">
                    <i class="fas fa-calendar-times fa-4x mb-3"></i>
                    <h5>No bookings found in this category.</h5>
                </div>
            @else
                @foreach ($bookings as $booking)
                    @php
                        $statusMessage = (!empty(trim($booking->status_msg)) && trim($booking->status_msg) !== 'Booking has been placed.') 
                            ? trim($booking->status_msg) 
                            : 'Your booking is pending approval by the mechanic.'; --}}

                        {{-- // Determine card color by status --}}
                        {{-- $borderClass = '';
                        switch ($booking->status) {
                            case 'pending':   $borderClass = 'border-left-warning'; break;
                            case 'accepted':  $borderClass = 'border-left-success'; break;
                            case 'completed': $borderClass = 'border-left-info'; break;
                            case 'cancelled': $borderClass = 'border-left-danger'; break;
                        }
                    @endphp

                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4 d-flex">
                        <div class="card shadow-sm {{ $borderClass }} w-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $booking->service->name ?? 'Service not found' }}</h5>
                                    <p class="card-text"><strong>Booking Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</p>
                                    <p class="card-text"><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</p>

                                    <p class="card-text">
                                        <strong>Status:</strong> 
                                        @if($booking->status === 'pending')
                                            <span class="badge badge-warning text-dark">Pending</span>
                                        @elseif($booking->status === 'accepted')
                                            <span class="badge badge-success">Accepted</span>
                                        @elseif($booking->status === 'completed')
                                            <span class="badge badge-info">Completed</span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    </p> --}}

                                    {{-- <p class="card-text">
                                        <strong>Status Message:</strong><br> {{ $statusMessage }}
                                    </p> --}}
                                {{-- </div>

                                @if($booking->status === 'pending')
                                    <div class="mt-auto">
                                        <button type="button" class="btn btn-cancel btn-sm mt-1" data-toggle="modal" data-target="#cancelModal-{{ $booking->id }}">
                                            <i class="fas fa-times-circle"></i> Cancel Booking
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div> --}}

                    <!-- Cancel Modal -->
                    {{-- <div class="modal fade" id="cancelModal-{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel-{{ $booking->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('user.bookings.cancel', ['booking' => $booking->id]) }}" method="POST">
                                @csrf

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel-{{ $booking->id }}">
                                            <i class="fas fa-times-circle"></i> Cancel Booking
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <p class="text-muted">Please select a reason for cancellation:</p>
                                        <select name="reason" class="form-control" required>
                                            <option value="" disabled selected>Choose a reason</option>
                                            @foreach ($cancellationReasons as $reason)
                                                <option value="{{ $reason }}">{{ $reason }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Confirm Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                @endforeach
            @endif
        </div>

    </div> --}}

    <!-- JS Scripts -->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>

</body>
</html> --}}
