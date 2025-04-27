<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Details - Carcare</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #eef2ff;
            --success: #28a745;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #1e293b;
            --gray: #64748b;
            --border-radius: 12px;
            --box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        .main-container {
            max-width: 800px;
            margin: 80px auto;
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .main-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--info));
        }

        .header-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            display: inline-block;
        }

        .header-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .booking-info {
            background-color: #fff;
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .info-item {
            display: flex;
            margin-bottom: 20px;
            align-items: flex-start;
        }

        .info-icon {
            font-size: 20px;
            color: var(--primary);
            margin-right: 15px;
            min-width: 30px;
            text-align: center;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-weight: 600;
            color: var(--gray);
            margin-bottom: 5px;
            font-size: 14px;
        }

        .info-value {
            font-size: 16px;
            color: var(--dark);
            font-weight: 500;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            text-transform: capitalize;
            gap: 8px;
        }

        .status-pending {
            background-color: var(--warning);
            color: #1e293b;
        }

        .status-accepted {
            background-color: var(--success);
            color: white;
        }

        .status-completed {
            background-color: var(--info);
            color: white;
        }

        .status-cancelled {
            background-color: var(--danger);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 12px 24px;
            font-size: 15px;
            border-radius: var(--border-radius);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-custom:active {
            transform: translateY(0);
        }

        .btn-back {
            background-color: var(--gray);
            color: white;
            border: none;
        }

        .btn-back:hover {
            background-color: #475569;
        }

        .btn-rate {
            background-color: blue;
            color: white;
            border: none;
        }

        .btn-rate:hover {
            background-color: #eab308;
        }

        .btn-disabled {
            background-color: #cbd5e1;
            color: #64748b;
            cursor: not-allowed;
        }

        /* Rating Modal */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .modal-header {
            background-color: var(--primary);
            color: white;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
            border-bottom: none;
            padding: 20px;
        }

        .modal-title {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border-top: 1px solid #f1f5f9;
            padding: 15px 25px;
        }

        .star-rating {
            display: flex;
            justify-content: center;
            gap: 12px;
            font-size: 2.5rem;
            margin: 20px 0;
            color: #e2e8f0;
            cursor: pointer;
        }

        .star-rating .fa-star.selected {
            color: #facc15;
        }

        .star-rating .fa-star:hover {
            color: #f59e0b;
        }

        .rating-label {
            text-align: center;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .comment-box {
            border-radius: var(--border-radius);
            border: 1px solid #e2e8f0;
            padding: 15px;
            transition: var(--transition);
        }

        .comment-box:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        footer {
            text-align: center;
            font-size: 14px;
            color: var(--gray);
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        /* Animation for status badge */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .status-pending.pulse {
            animation: pulse 1.5s infinite;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-container {
                margin: 60px 20px;
                padding: 30px;
            }
            
            .header-title {
                font-size: 28px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-custom {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .main-container {
                padding: 25px 20px;
            }
            
            .header-title {
                font-size: 24px;
            }
            
            .booking-info {
                padding: 20px;
            }
            
            .info-item {
                flex-direction: column;
                gap: 5px;
            }
            
            .star-rating {
                font-size: 2rem;
                gap: 8px;
            }
        }
        .btn-receipt {
            background-color: var(--info);
            color: white;
            border: none;
        }

        .btn-receipt:hover {
            background-color: #0ea5e9;
        }
        
        .reference-number {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: var(--primary);
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-usersidebar />

    <!-- Main Content -->
    <div class="main-container animate__animated animate__fadeIn">
        <h1 class="header-title">
            <i class="fas fa-calendar-check"></i> Booking Details
        </h1>

        <div class="booking-info">
            <!-- Booking Reference Number -->
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-hashtag"></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Booking ID</div>
                    <div class="info-value reference-number">
                        @php
                            // Generate alphanumeric reference
                            $shopInitials = strtoupper(substr($booking->mechanic->shopname ?? 'CAR', 0, 3));
                            $datePart = $booking->created_at->format('Ymd');
                            $randomPart = substr(md5($booking->id), 0, 6);
                            $bookingReference = $shopInitials  . $datePart  . $randomPart;
                        @endphp
                        {{ $bookingReference }}
                    </div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Service</div>
                    <div class="info-value">{{ $booking->service->name }}</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Schedule Date & Time</div>
                    <div class="info-value">
                        {{ $booking->booking_date }} at {{ $booking->booking_time }}
                    </div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-comment-alt"></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Reason</div>
                    <div class="info-value">{{ $booking->reason ?? 'No reason provided' }}</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="status-badge 
                            @if($booking->status === 'pending') status-pending pulse
                            @elseif($booking->status === 'accepted') status-accepted
                            @elseif($booking->status === 'completed') status-completed
                            @elseif($booking->status === 'cancelled') status-cancelled
                            @endif">
                            <i class="fas 
                                @if($booking->status === 'pending') fa-clock
                                @elseif($booking->status === 'accepted') fa-check-circle
                                @elseif($booking->status === 'completed') fa-check-double
                                @elseif($booking->status === 'cancelled') fa-times-circle
                                @endif">
                            </i>
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('user.bookings.pending') }}" class="btn-custom btn-back">
                <i class="fas fa-arrow-left"></i> Back to Bookings
            </a>

            @if ($booking->status === 'completed')
                <a href="{{ route('user.bookings.receipt', $booking->id) }}" class="btn-custom btn-receipt">
                    <i class="fas fa-receipt"></i> Download Receipt
                </a>
            @endif

            @if ($booking->status === 'completed' && !$hasRated)
                <button class="btn-custom btn-rate"
    data-bs-toggle="modal"
    data-bs-target="#rateModal"
    data-booking-id="{{ $booking->id }}"
    data-service-name="{{ $booking->service->name }}">
    <i class="fas fa-star"></i> Rate Service 👈
</button>
            @elseif ($hasRated)
                <button class="btn-custom btn-disabled" disabled>
                    <i class="fas fa-check"></i> Already Rated
                </button>
            @endif
        </div>
    </div>

    <!-- Rating Modal -->
    <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('service-ratings.store') }}" method="POST" id="ratingForm">
                    @csrf
                    <input type="hidden" name="booking_id" id="modalBookingId">
                    <input type="hidden" name="service_id" value="{{ $booking->service->id }}">
                    <input type="hidden" name="rating" id="ratingInput" required>

                    <div class="modal-header">
                        <h5 class="modal-title" id="rateModalLabel">
                            <i class="fas fa-star"></i> Rate Service
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <div class="rating-label">How would you rate this service?</div>
                            <div class="star-rating">
                                <i class="fas fa-star" data-value="1"></i>
                                <i class="fas fa-star" data-value="2"></i>
                                <i class="fas fa-star" data-value="3"></i>
                                <i class="fas fa-star" data-value="4"></i>
                                <i class="fas fa-star" data-value="5"></i>
                            </div>
                            <small class="text-muted">Click to rate from 1 to 5 stars</small>
                        </div>

                        <div class="form-group">
                            <label for="comment" class="form-label fw-semibold">Your Feedback (optional)</label>
                            <textarea class="form-control comment-box" id="comment" name="comment" rows="4"
                                placeholder="Share your experience with this service..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i> Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} CarCare. All rights reserved.
    </footer>

    <!-- External Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Success/Error Messages
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#4361ee',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#e74c3c',
                confirmButtonText: 'OK'
            });
        @endif

        $(document).ready(function () {
            let selectedRating = 0;

            // Initialize modal with booking data
            $('#rateModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const bookingId = button.data('booking-id');
                const serviceName = button.data('service-name');

                $('#modalBookingId').val(bookingId);
                $('#rateModalLabel').html(`<i class="fas fa-star"></i> Rate ${serviceName}`);
                resetStars();
            });

            // Reset stars when modal is hidden
            $('#rateModal').on('hidden.bs.modal', function () {
                resetStars();
            });

            // Star rating interaction
            $('.star-rating .fa-star')
                .on('mouseover', function () {
                    highlightStars($(this).data('value'));
                })
                .on('mouseout', function () {
                    highlightStars(selectedRating);
                })
                .on('click', function () {
                    selectedRating = $(this).data('value');
                    $('#ratingInput').val(selectedRating);
                    highlightStars(selectedRating);
                });

            // Form submission handling
            $('#ratingForm').on('submit', function(e) {
                if ($('#ratingInput').val() === '') {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Rating Required',
                        text: 'Please select a star rating before submitting',
                        icon: 'warning',
                        confirmButtonColor: '#4361ee'
                    });
                }
            });

            // Helper functions
            function highlightStars(rating) {
                $('.star-rating .fa-star').each(function () {
                    if ($(this).data('value') <= rating) {
                        $(this).addClass('selected');
                    } else {
                        $(this).removeClass('selected');
                    }
                });
            }

            function resetStars() {
                selectedRating = 0;
                $('#ratingInput').val('');
                $('.star-rating .fa-star').removeClass('selected');
            }
        });
    </script>

</body>

</html>