<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accepted Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

    <style>
        :root {
            --primary-color: #4361ee;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container-bordered {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
            max-width: 1200px;
            margin: 80px auto;
        }

        h2 {
            color: #2b2d42;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* Booking Tabs */
        .booking-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            border-bottom: none;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 50px;
        }

        .booking-tabs li {
            list-style: none;
            margin: 0 8px;
        }

        .booking-tabs a {
            display: block;
            padding: 10px 25px;
            color: #495057;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 50px;
            font-size: 0.95rem;
        }

        .booking-tabs a.active {
            color: white;
            background: var(--primary-color);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .booking-tabs a:hover:not(.active) {
            color: var(--primary-color);
            background: rgba(67, 97, 238, 0.1);
        }

        /* Card Styles */
        .booking-card {
    border: none;
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
    height: 100%; /* Make card fill the height of its column */
    display: flex;
    flex-direction: column;
}

        .booking-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.05);
        }

        .booking-card .card-body {
            padding: 1.75rem;
        }

        .card-header {
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            padding: 15px 20px;
            border-bottom: none;
        }

        .card-header h5 {
            font-weight: 600;
            margin-bottom: 0;
        }

        .card-header .badge {
            font-size: 0.75rem;
            padding: 5px 10px;
            border-radius: 50px;
        }

        .booking-detail {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .booking-detail i {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-right: 12px;
            margin-top: 3px;
            min-width: 20px;
        }

        .booking-detail-content {
            flex: 1;
        }

        .booking-detail-label {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .booking-detail-value {
            font-size: 0.95rem;
            color: #212529;
            font-weight: 500;
        }

        .status-message {
            background: #f8f9fa;
            border-left: 4px solid var(--success-color);
            padding: 12px;
            border-radius: 0 8px 8px 0;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .status-message strong {
            color: #212529;
        }

        .mechanic-info {
            background: #f1f8ff;
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
            border-left: 4px solid var(--info-color);
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
        }

        .empty-state i {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .empty-state h5 {
            color: #6c757d;
            font-weight: 600;
        }

        .empty-state p {
            color: #adb5bd;
            max-width: 500px;
            margin: 0 auto 25px;
        }

        .btn-book {
            background: var(--primary-color);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-book:hover {
            background: #3a0ca3;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
        }

        /* Clickable Card */
        .clickable-card {
            display: block;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
        }

        .clickable-card:hover {
            text-decoration: none;
            color: inherit;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-bordered {
                padding: 30px 15px;
                margin: 60px auto;
            }

            .booking-tabs {
                flex-wrap: wrap;
                border-radius: 12px;
            }

            .booking-tabs li {
                margin: 5px;
                width: calc(50% - 10px);
            }

            .booking-tabs a {
                padding: 8px 15px;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.75rem;
            }

            .booking-card .card-body {
                padding: 1.25rem;
            }
        }
        .booking-tabs .badge {
    font-size: 0.75rem;
    vertical-align: middle;
}

    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-usersidebar />

    <!-- Container -->
    <div class="container container-bordered">

        <!-- Heading -->
        <h2 class="text-center mb-4"><i class="fas fa-clipboard-check mr-2"></i>Accepted Bookings</h2>
        
        @php
    $pendingCount = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'pending')->count();
    $acceptedCount = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'accepted')->count();
    $completedCount = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'completed')->count();
    $cancelledCount = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'cancelled')->count();
@endphp


        <!-- Navigation Tabs -->
        <ul class="booking-tabs mb-4">
    <li>
        <a href="{{ route('user.bookings.pending') }}" class="{{ request()->routeIs('user.bookings.pending') ? 'active' : '' }}">
            Pending
            @if($pendingCount > 0)
                <span class="badge badge-pill badge-warning ml-1">{{ $pendingCount }}</span>
            @endif
        </a>
    </li>
    <li>
        <a href="{{ route('user.bookings.accepted') }}" class="{{ request()->routeIs('user.bookings.accepted') ? 'active' : '' }}">
            Accepted
            @if($acceptedCount > 0)
                <span class="badge badge-pill badge-info ml-1">{{ $acceptedCount }}</span>
            @endif
        </a>
    </li>
    <li>
        <a href="{{ route('user.bookings.completed') }}" class="{{ request()->routeIs('user.bookings.completed') ? 'active' : '' }}">
            Completed
            @if($completedCount > 0)
                <span class="badge badge-pill badge-success ml-1">{{ $completedCount }}</span>
            @endif
        </a>
    </li>
    <li>
        <a href="{{ route('user.bookings.cancelled.list') }}" class="{{ request()->routeIs('user.bookings.cancelled.list') ? 'active' : '' }}">
            Cancelled
            @if($cancelledCount > 0)
                <span class="badge badge-pill badge-danger ml-1">{{ $cancelledCount }}</span>
            @endif
        </a>
    </li>
</ul>


        <!-- Accepted Bookings -->
        <div class="row">
            @if ($bookings->isEmpty())
                <div class="col-12">
                    <div class="empty-state">
                        <i class="far fa-calendar-check"></i>
                        <h5 class="mt-3">No Accepted Bookings</h5>
                        <p>You don't have any accepted service appointments at the moment. Check your pending bookings or schedule a new service.</p>

                    </div>
                </div>
            @else
                @foreach ($bookings as $booking)
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4 d-flex">
                    <!-- Clickable Card -->
                    <a href="{{ route('user.bookings.show', $booking->id) }}" class="clickable-card w-100">
                        <div class="card booking-card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="fas fa-wrench mr-2"></i>{{ $booking->service->name ?? 'Service' }}
                                    </h5>
                                    <span class="badge badge-success">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                                
                                <div class="card-body">
                                    
                                    <div class="booking-detail">
                                    <i class="fas fa-store-alt"></i>                                    
                                    <div class="booking-detail-content">
                                        <div class="booking-detail-label"></div>
                                        <div class="booking-detail-value">
                                            {{ $booking->mechanic->shopname ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                
                                    <!-- Booking Date -->
                                    <div class="booking-detail">
                                        <i class="far fa-calendar-alt"></i>
                                        <div class="booking-detail-content">
                                            <div class="booking-detail-label">Booking Date</div>
                                            <div class="booking-detail-value">
                                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Booking Time -->
                                    <div class="booking-detail">
                                        <i class="far fa-clock"></i>
                                        <div class="booking-detail-content">
                                            <div class="booking-detail-label">Time</div>
                                            <div class="booking-detail-value">
                                                {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Service Reason -->
                                    @if($booking->reason)
                                    <div class="booking-detail">
                                        <i class="far fa-comment-dots"></i>
                                        <div class="booking-detail-content">
                                            <div class="booking-detail-label">Service Reason</div>
                                            <div class="booking-detail-value">
                                                {{ $booking->reason }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <!-- Mechanic Info -->
                                    @if($booking->status === 'accepted' && $booking->mechanic)
                                    <div class="mechanic-info">
                                        <div class="booking-detail">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div class="booking-detail-content">
                                                <div class="booking-detail-label">Service Location</div>
                                                <div class="booking-detail-value">
                                                    {{ $booking->mechanic->Address }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <!-- Status Message -->
                                    <div class="status-message">
                                        <i class="fas fa-info-circle mr-2 text-success"></i>
                                        @if ($booking->status === 'accepted')
                                            Your booking has been accepted! Please arrive on time.
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Add animation to cards when they come into view
            $('.booking-card').each(function(i) {
                $(this).delay(i * 150).animate({
                    opacity: 1,
                    top: 0
                }, 400);
            });
        });
    </script>

</body>

</html>