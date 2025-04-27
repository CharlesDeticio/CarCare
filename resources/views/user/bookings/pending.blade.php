<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pending Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <!-- Custom CSS -->
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
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
        }

        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.05);
        }

        .booking-card .card-header {
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            padding: 15px 20px;
            border-bottom: none;
        }

        .booking-card .card-body {
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .card-header h5 {
            font-weight: 600;
            margin-bottom: 0;
        }

        .card-header .badge {
            font-size: 0.75rem;
            padding: 5px 10px;
            border-radius: 50px;
            margin-top: 5px;
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
            border-left: 4px solid var(--warning-color);
            padding: 12px;
            border-radius: 0 8px 8px 0;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .status-message strong {
            color: #212529;
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

        .btn-cancel {
            background: white;
            color: var(--danger-color);
            border: 1px solid var(--danger-color);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s;
            margin-top: auto;
            align-self: flex-start;
        }

        .btn-cancel:hover {
            background: var(--danger-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.3);
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: var(--danger-color);
            color: white;
            padding: 15px 20px;
            border-bottom: none;
        }

        .modal-title i {
            margin-right: 10px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            border-top: none;
            padding: 15px 20px;
        }

        .booking-tabs .badge {
            font-size: 0.75rem;
            vertical-align: middle;
        }

        /* Card Container Styles */
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .row > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }

        .booking-card-container {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }

        .btn-cancel-container {
            margin-top: auto;
            padding-top: 15px;
        }

        .clickable-card {
            display: flex;
            flex-direction: column;
            height: 100%;
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
    </style>
</head>

<body>

    <!-- User Sidebar -->
    <x-usersidebar />

    <div class="container container-bordered">

        <!-- Page Title -->
        <h2 class="text-center mb-4"><i class="fas fa-hourglass-half mr-2"></i>Pending Bookings</h2>
        
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

        <!-- Booking Cards -->
        <div class="row">
                        @if ($bookings->isEmpty())
                <div class="col-12">
                    <div class="empty-state">
                        <i class="far fa-clock"></i>
                        <h5 class="mt-3">No Pending Bookings</h5>
                        <p>You don't have any pending service appointments at the moment. Check your accepted bookings or schedule a new service.</p>
                    </div>
                </div>
            @else
                @foreach ($bookings as $booking)
                    @php
                        $statusMessage = (!empty(trim($booking->status_msg)) && trim($booking->status_msg) !== 'Booking has been placed.'
                            ? trim($booking->status_msg)
                            : 'Your booking is pending');
                    @endphp
            
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="booking-card-container">
                            <a href="{{ route('user.bookings.show', $booking->id) }}" class="clickable-card">
                                <div class="card booking-card">
                                    <div class="card-header text-center">
                                        <h5 class="mb-0">
                                            <i class="fas fa-wrench mr-2"></i>{{ $booking->service->name ?? 'Service' }}
                                        </h5>
                                        <span class="badge badge-warning">
                                            Pending
                                        </span>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="booking-detail">
                                            <i class="fas fa-store-alt"></i>                                    
                                            <div class="booking-detail-content">
                                                <div class="booking-detail-label">Mechanic Shop</div>
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
                                        
                                        <!-- Status Message -->
                                        <div class="status-message">
                                            <i class="fas fa-info-circle mr-2 text-warning"></i>
                                            {{ $statusMessage }}
                                        </div>
                                        
                                        <!-- Cancel Button -->
                                        <div class="btn-cancel-container">
                                            <button type="button" class="btn btn-cancel" data-toggle="modal" data-target="#cancelModal-{{ $booking->id }}">
                                                <i class="fas fa-times-circle mr-2"></i>Cancel Booking
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Cancel Modal -->
                        <div class="modal fade" id="cancelModal-{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel-{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="{{ route('user.bookings.cancel', ['booking' => $booking->id]) }}" method="POST" class="cancel-booking-form">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelModalLabel-{{ $booking->id }}">
                                                <i class="fas fa-exclamation-triangle mr-2"></i>Cancel Booking
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                
                                        <div class="modal-body">
                                            <div class="alert alert-warning">
                                                <i class="fas fa-info-circle mr-2"></i> Are you sure you want to cancel this booking?
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="reasonSelect-{{ $booking->id }}" class="font-weight-bold">Cancellation Reason</label>
                                                <select name="reason" id="reasonSelect-{{ $booking->id }}" class="form-control custom-select" required>
                                                    <option value="" disabled selected>Select a reason...</option>
                                                    @foreach ($cancellationReasons as $reason)
                                                        <option value="{{ $reason }}">{{ $reason }}</option>
                                                    @endforeach
                                                    <option value="Other">Other (please specify)</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group other-reason-container" style="display: none;">
                                                <label for="otherReason-{{ $booking->id }}">Please specify</label>
                                                <textarea class="form-control" id="otherReason-{{ $booking->id }}" name="other_reason" rows="2"></textarea>
                                            </div>
                                        </div>
                                
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-arrow-left mr-2"></i>Go Back
                                            </button>
                                            <button type="submit" class="btn btn-danger cancel-submit-btn">
                                                <i class="fas fa-times-circle mr-2"></i>Confirm Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Handle cancellation form submission
            $(".cancel-booking-form").on("submit", function(e) {
                const submitBtn = $(this).find(".cancel-submit-btn");
                submitBtn.prop("disabled", true);
                submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Processing...');
            });
            
            // Show/hide other reason textarea
            $('select[name="reason"]').on('change', function() {
                const form = $(this).closest('form');
                const otherReasonContainer = form.find('.other-reason-container');
                
                if ($(this).val() === 'Other') {
                    otherReasonContainer.show();
                    form.find('textarea[name="other_reason"]').prop('required', true);
                } else {
                    otherReasonContainer.hide();
                    form.find('textarea[name="other_reason"]').prop('required', false);
                }
            });
        });
    </script>
</body>

</html>