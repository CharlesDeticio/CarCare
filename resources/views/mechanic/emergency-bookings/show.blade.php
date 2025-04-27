<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Booking Details | Carcare</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">

    <style>
        :root {
            --primary-color: #6C63FF;
            --secondary-color: #00CFE8;
            --text-color: #333;
            --bg-color: #f9f9f9;
            --white: #ffffff;
            --gray: #f1f1f1;
            --dark-gray: #777;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .main-content {
            margin: 40px auto;
            padding: 40px 20px;
            max-width: 900px;
            margin-left: 350px;
            margin-top: 60px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
        }

        .page-description {
            font-size: 16px;
            color: var(--dark-gray);
            margin-bottom: 40px;
            text-align: center;
        }

        .card {
            border: none;
            border-radius: 12px;
            background-color: var(--white);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            padding: 20px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 30px;
        }

        .card-body p {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .card-body p strong {
            display: inline-block;
            min-width: 150px;
        }

        .booking-reason {
            padding: 15px;
            background-color: var(--gray);
            border-left: 5px solid var(--primary-color);
            border-radius: 6px;
            font-style: italic;
            color: var(--dark-gray);
        }

        .btn-back {
            display: inline-block;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid #fff;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
            text-decoration: none;
        }

        .action-buttons {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .btn-accept {
            background-color: #ffc107;
            color: #fff;
            border-radius: 30px;
            padding: 10px 24px;
            border: none;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .btn-accept:hover {
            background-color: #e0a800;
        }

        .btn-complete {
            background-color: #28a745;
            color: #fff;
            border-radius: 30px;
            padding: 10px 24px;
            border: none;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .btn-complete:hover {
            background-color: #218838;
        }

        footer {
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            color: var(--dark-gray);
            font-size: 14px;
        }

        .emergency-booking-card {
            border-left: 4px solid #dc3545;
        }
        
        .booking-description {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        
        .rating-section {
            margin-top: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 20px;
                margin-left: 0;
            }

            .card-body p strong {
                display: block;
                margin-bottom: 5px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-back {
                margin-top: 10px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar-wrapper">
        <x-sidebar />
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Page Heading -->
        <h1 class="page-title"><i class="fas fa-car-crash"></i> Emergency Booking Details</h1>
        <p class="page-description">Here is the complete information for this emergency booking.</p>

        <!-- Booking Details Card -->
        <div class="card emergency-booking-card mb-5">
            <div class="card-header">
                <div>
                    <span class="badge bg-danger me-2">
                        <i class="fas fa-car-crash me-1"></i>EMB{{ $booking->id }}
                    </span>
                    <span>Emergency Booking Details</span>
                </div>
                <a href="{{ route('mechanic.emergency.bookings.status') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="card-title"><i class="fas fa-user"></i> Customer Information</h5>
                        <p class="mb-1"><strong>Name:</strong> {{ $booking->user->first_name ?? 'N/A' }} {{ $booking->user->last_name ?? '' }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $booking->user->phone_number ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Vehicle:</strong> {{ $booking->vehicle_make ?? 'Not specified' }} {{ $booking->vehicle_model ?? '' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title"><i class="fas fa-info-circle"></i> Booking Details</h5>
                        <p class="mb-1"><strong>Date:</strong> {{ $booking->created_at->format('M d, Y h:i A') }}</p>
                        <p class="mb-1"><strong>Location:</strong> {{ $booking->emergency_address }}</p>
                        <p class="mb-1"><strong>Status:</strong> 
                            <span class="badge bg-{{ $booking->status == 'completed' ? 'success' : ($booking->status == 'accepted' ? 'primary' : 'warning') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <div class="booking-description">
                    <h5><i class="fas fa-exclamation-triangle"></i> Problem Description</h5>
                    <p>{{ $booking->emergency_reason }}</p>
                </div>
                
                @if($booking->status == 'completed' && isset($rating))
                    <div class="rating-section">
                        <h5><i class="fas fa-star"></i> Customer Rating</h5>
                        <div class="d-flex align-items-center mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-secondary' }}"></i>
                            @endfor
                            <span class="ms-2">{{ $rating->rating }}/5</span>
                        </div>
                        @if($rating->feedback)
                            <p class="mb-1"><strong>Feedback:</strong> {{ $rating->feedback }}</p>
                        @endif
                        <small class="text-muted">
                            <span class="badge bg-info">
                                <i class="fas fa-car-crash me-1"></i>Booking EMB{{ $rating->emergency_booking_id }}
                            </span>
                            rated on {{ $rating->created_at->format('M d, Y') }}
                        </small>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="action-buttons">
                    @if($booking->status === 'pending')
                        <button class="btn-accept" onclick="confirmAccept({{ $booking->id }})">
                            <i class="fas fa-check-circle"></i> Accept Booking
                        </button>
                    @elseif($booking->status === 'accepted')
                        <button class="btn-complete" onclick="confirmComplete({{ $booking->id }})">
                            <i class="fas fa-check-circle"></i> Mark as Completed
                        </button>
                    @elseif($booking->status === 'completed')
                        <button class="btn btn-secondary" disabled>
                            <i class="fas fa-check-circle"></i> Completed
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            &copy; {{ date('Y') }} Carcare. All rights reserved.
        </footer>
    </div>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/script2.js') }}"></script>

    <!-- CSRF and AJAX Setup -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        let actionInProgress = false;
    
        function confirmAccept(bookingId) {
            if (actionInProgress) return;
    
            Swal.fire({
                title: 'Accept this booking?',
                text: 'Are you sure you want to accept this emergency booking?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Accept',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    disableButtons();
                    acceptBooking(bookingId);
                }
            });
        }
    
        function confirmComplete(bookingId) {
            if (actionInProgress) return;
    
            Swal.fire({
                title: 'Complete this booking?',
                text: 'Confirm that you have completed this emergency service.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes, Complete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    disableButtons();
                    completeBooking(bookingId);
                }
            });
        }
    
        function disableButtons() {
            actionInProgress = true;
            const buttons = document.querySelectorAll('.action-buttons button');
            buttons.forEach(btn => {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            });
        }
    
        function acceptBooking(bookingId) {
            $.ajax({
                url: `/emergency-booking/${bookingId}/accept`,
                type: 'POST',
                success: function(response) {
                    Swal.fire('Accepted!', response.message, 'success');
                    setTimeout(() => { location.reload(); }, 1500);
                },
                error: function(xhr) {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                    actionInProgress = false;
                }
            });
        }
    
        function completeBooking(bookingId) {
            $.ajax({
                url: `/emergency-booking/${bookingId}/complete`,
                type: 'POST',
                success: function(response) {
                    Swal.fire('Completed!', response.message, 'success');
                    setTimeout(() => { location.reload(); }, 1500);
                },
                error: function(xhr) {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                    actionInProgress = false;
                }
            });
        }
    </script>
</body>
</html>