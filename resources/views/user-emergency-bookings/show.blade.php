<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Emergency Booking Details - CarCare</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #334155;
        }

        .header-banner {
            background: linear-gradient(90deg, #1e40af, #3b82f6);
            color: #fff;
            padding: 50px 0;
            text-align: center;
            margin-bottom: 40px;
        }

        .header-banner h1 {
            font-size: 36px;
            font-weight: 700;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: #ffffff;
            padding: 30px;
            margin-bottom: 40px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .card h3 {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .detail-row {
            margin-bottom: 20px;
        }

        .label {
            font-weight: 600;
            color: #475569;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .value {
            color: #1e293b;
            font-size: 16px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: pre-wrap;
            background-color: #f8fafc;
            padding: 12px;
            border-radius: 8px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
            margin-left: 650px;
        }

        .badge-pending {
            background-color: #facc15;
            color: #1e293b;
        }

        .badge-accepted {
            background-color: #22c55e;
            color: #fff;
        }

        .badge-on-the-way {
            background-color: #3b82f6;
            color: #fff;
        }

        .badge-completed {
            background-color: #6366f1;
            color: #fff;
        }

        .badge-cancelled {
            background-color: #ef4444;
            color: #fff;
        }

        .btn-back {
            background-color: #ef4444;
            color: #fff;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #dc2626;
            color: #fff;
        }

        .mechanic-section {
            background-color: #f1f5f9;
            padding: 20px;
            border-radius: 8px;
        }

        footer {
            text-align: center;
            padding: 20px 0;
            font-size: 14px;
            color: #64748b;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .star {
    font-size: 30px;
    color: #d1d5db; /* light gray by default */
    cursor: pointer;
    transition: color 0.2s;
}
.star.hover,
.star.selected {
    color: #fbbf24; /* amber-400 */
}

    </style>
</head>

<body>

    <!-- Header -->
    <!-- Header -->
<div class="header-banner">
    <h1><i class="fas fa-ambulance"></i> Emergency Booking Details</h1>
</div>

<div class="container">
    <div class="card">
        <h3>Booking Information</h3>

        <!-- Booking ID -->
<div class="detail-row">
    <div class="label"> ID:</div>
    <div class="value d-flex align-items-center gap-2">
        <span class="badge badge-primary p-2 d-flex align-items-center">
            <i class="fas fa-car-crash me-2"></i>
            <span>EMB{{ $booking->id }}</span>
        </span>
    </div>
</div>

        <!-- Reason for Emergency -->
        <div class="detail-row">
            <div class="label">Reason for Emergency:</div>
            <div class="value">{{ $booking->emergency_reason }}</div>
        </div>

        <!-- Emergency Address -->
        <div class="detail-row">
            <div class="label">Emergency Address:</div>
            <div class="value">{{ $booking->emergency_address }}</div>
        </div>

        <!-- Status -->
        <div class="detail-row">
            <div class="label">Status:</div>
            @switch($booking->status)
                @case('pending')
                    <span class="status-badge badge-pending">Pending</span>
                    @break
                @case('accepted')
                    <span class="status-badge badge-accepted">Accepted</span>
                    @break
                @case('on_the_way')
                    <span class="status-badge badge-on-the-way">On the Way</span>
                    @break
                @case('completed')
                    <span class="status-badge badge-completed">Completed</span>
                    @break
                @case('cancelled')
                    <span class="status-badge badge-cancelled">Cancelled</span>
                    @break
                @default
                    <span class="status-badge badge-secondary">{{ ucfirst($booking->status) }}</span>
            @endswitch
        </div>

        @if ($booking->status === 'completed')
            @php
                $existingRating = \App\Models\EmergencyBookingRating::where('emergency_booking_id', $booking->id)
                                    ->where('user_id', auth()->id())->first();
            @endphp

            <div class="mt-5">
                <h3><i class="fas fa-star"></i> Rate This Emergency Service</h3>

                @if ($existingRating)
                    <div class="alert alert-success mt-3">
                        <strong>Thank you!</strong> You've already rated this emergency service.
                        <br>
                        <strong>Rating:</strong> {{ $existingRating->rating }} ★
                        <br>
                        <strong>Comment:</strong> {{ $existingRating->comment ?? 'No comment provided.' }}
                    </div>
                @else
                    <form action="{{ route('emergency.rating.store', $booking->id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="rating">Your Rating</label>
                            <div id="star-rating" class="mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star star" data-value="{{ $i }}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating" required>
                        </div>
                        

                        <div class="form-group">
                            <label for="comment">Comment (optional)</label>
                            <textarea name="comment" id="comment" class="form-control" rows="4" maxlength="1000" placeholder="Write your comment..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit Rating</button>
                    </form>
                @endif
            </div>
        @endif

        <!-- Date Requested -->
        <div class="detail-row">
            <div class="label">Date Requested:</div>
            <div class="value">{{ $booking->created_at->format('M d, Y h:i A') }}</div>
        </div>

        <!-- Mechanic Info -->
        <h3 class="mt-5"><i class="fas fa-tools"></i> Assigned Shop</h3>
        <div class="mechanic-section">
            @if ($booking->mechanic)
                <div class="detail-row">
                    <div class="label">Shop Name:</div>
                    <div class="value">{{ $booking->mechanic->shopname ?? 'N/A' }}</div>
                </div>

                <div class="detail-row">
                    <div class="label">Contact Number:</div>
                    <div class="value">{{ $booking->mechanic->ContactNo ?? 'N/A' }}</div>
                </div>

                <div class="detail-row">
                    <div class="label">Email Address:</div>
                    <div class="value">{{ $booking->mechanic->email ?? 'N/A' }}</div>
                </div>
            @else
                <div class="alert alert-info mb-0">No mechanic assigned yet.</div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="mt-5 text-center">
            <a href="{{ route('user.emergency.bookings.status') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Back to My Bookings
            </a>
        </div>
    </div>
</div>
    <footer>
        &copy; {{ date('Y') }} CarCare. All Rights Reserved.
    </footer>
    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');
    
        stars.forEach((star, idx) => {
            star.addEventListener('mouseover', () => {
                highlightStars(idx + 1);
            });
    
            star.addEventListener('mouseout', () => {
                highlightStars(ratingInput.value);
            });
    
            star.addEventListener('click', () => {
                ratingInput.value = idx + 1;
                highlightStars(idx + 1);
            });
        });
    
        function highlightStars(rating) {
            stars.forEach((star, idx) => {
                if (idx < rating) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    </script>
    
    <!-- Bootstrap JS + Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
