<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cancelled Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

    <style>
        :root {
            --primary-color: #4361ee;
            --danger-color: #dc3545;
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

        .booking-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
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
            background: var(--danger-color);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        .booking-tabs a:hover:not(.active) {
            color: var(--danger-color);
            background: rgba(220, 53, 69, 0.1);
        }

        .booking-card {
            border: none;
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        .booking-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1);
        }

        .booking-card .card-body {
            padding: 1.75rem;
        }

        .card-header {
            background: linear-gradient(135deg, #dc3545 0%, #a4161a 100%);
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
            color: var(--danger-color);
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
            border-left: 4px solid var(--danger-color);
            padding: 12px;
            border-radius: 0 8px 8px 0;
            margin-top: 20px;
            font-size: 0.9rem;
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

        @media (max-width: 768px) {
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
        .clickable-card {
    text-decoration: none;
    color: inherit;
    display: block;
    transition: all 0.2s;
}

.clickable-card:hover {
    text-decoration: none;
    color: inherit;
}
.booking-tabs .badge {
    font-size: 0.75rem;
    vertical-align: middle;
}

    </style>
</head>

<body>

    <x-usersidebar />

    <div class="container container-bordered">
        <h2 class="text-center mb-4"><i class="fas fa-ban mr-2"></i>Cancelled Bookings</h2>

@php
    $pendingCount = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'pending')->count();
    $acceptedCount = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'accepted')->count();
    $completedCount = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'completed')->count();
    $cancelledCount = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'cancelled')->count();
@endphp

        <!-- Tabs -->
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

        <!-- Cancelled Cards -->
        <div class="row">
            @if ($bookings->isEmpty())
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h5 class="mt-3">No Cancelled Bookings</h5>
                        <p>You don’t have any cancelled bookings. Try checking other tabs or book a new service.</p>
                    </div>
                </div>
            @else
                @foreach ($bookings as $booking)
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <a href="{{ route('user.bookings.show', $booking->id) }}" class="clickable-card">
                            <div class="card booking-card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="fas fa-wrench mr-2"></i>{{ $booking->service->name ?? 'Service' }}
                                    </h5>
                                    <span class="badge badge-danger">Cancelled</span>
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
                                
                                    <div class="booking-detail">
                                        <i class="far fa-calendar-alt"></i>
                                        <div class="booking-detail-content">
                                            <div class="booking-detail-label">Booking Date</div>
                                            <div class="booking-detail-value">
                                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="booking-detail">
                                        <i class="far fa-clock"></i>
                                        <div class="booking-detail-content">
                                            <div class="booking-detail-label">Time</div>
                                            <div class="booking-detail-value">
                                                {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="booking-detail">
                                        <i class="fas fa-comment-slash"></i>
                                        <div class="booking-detail-content">
                                            <div class="booking-detail-label">Cancellation Reason</div>
                                            <div class="booking-detail-value">
                                                {{ $booking->reason ?? 'Not specified' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="status-message">
                                        <i class="fas fa-info-circle mr-2 text-danger"></i>
                                        This booking was cancelled and is no longer active.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>

</body>
</html>
