<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->name }} | Service Details</title>
    
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #3f37c9;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 15px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .back-btn:hover {
            background-color: rgba(0, 0, 0, 0.7);
            transform: translateX(-3px);
        }
        
        .hero {
            position: relative;
            height: 400px;
            overflow: hidden;
            margin-bottom: 60px;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));
            z-index: 1;
        }
        
        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .hero:hover .hero-img {
            transform: scale(1.05);
        }
        
        .hero-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 30px;
            color: white;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-price {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--warning);
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .service-details-section {
            background: white;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-top: -80px;
            position: relative;
            z-index: 3;
        }
        
        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 3px;
        }
        
        .service-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--dark);
        }
        
        .btn-book {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: var(--border-radius);
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-book:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
        }
        
        .rating-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 30px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
        }
        
        .average-rating {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .stars {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        
        .star-filled {
            color: var(--warning);
        }
        
        .star-empty {
            color: var(--light-gray);
        }
        
        .review-count {
            color: var(--gray);
            font-size: 1rem;
        }
        
        .review-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            margin-bottom: 20px;
            transition: var(--transition);
        }
        
        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 15px;
            text-transform: uppercase;
        }
        
        .review-user {
            flex: 1;
        }
        
        .review-user-name {
            font-weight: 600;
            margin-bottom: 3px;
        }
        
        .review-date {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .review-rating {
            color: var(--warning);
        }
        
        .review-comment {
            color: var(--dark);
            line-height: 1.7;
            margin-bottom: 15px;
        }
        
        .review-image {
            max-width: 100%;
            border-radius: var(--border-radius);
            margin-top: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .no-reviews {
            text-align: center;
            padding: 40px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .no-reviews-icon {
            font-size: 3rem;
            color: var(--light-gray);
            margin-bottom: 20px;
        }
        
        .no-reviews-text {
            color: var(--gray);
            font-size: 1.2rem;
        }
        
        /* Booking Modal */
        .modal-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }
        
        .modal-title {
            font-weight: 600;
        }
        
        .btn-close-white {
            filter: invert(1);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 8px;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: var(--border-radius);
            border: 1px solid var(--light-gray);
            transition: var(--transition);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero {
                height: 350px;
            }
            
            .hero-title {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero {
                height: 300px;
                margin-bottom: 40px;
            }
            
            .service-details-section {
                margin-top: -40px;
                padding: 30px;
            }
            
            .hero-content {
                padding: 20px;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero {
                height: 250px;
            }
            
            .service-details-section {
                padding: 25px 20px;
            }
            
            .hero-title {
                font-size: 1.5rem;
            }
            
            .hero-price {
                font-size: 1.2rem;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
            
            .service-description {
                font-size: 1rem;
            }
            
            .back-btn {
                top: 15px;
                left: 15px;
                padding: 8px 12px;
                font-size: 0.9rem;
            }
        }
        .time-slots-container {
    background-color: var(--light-gray);
    padding: 20px;
    border-radius: var(--border-radius);
}

.time-slot-heading {
    color: var(--primary);
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-check:checked + .btn-outline-primary {
    background-color: var(--primary);
    color: white;
    border-color: var(--primary);
}

.btn-outline-primary {
    text-align: left;
    padding: 10px 15px;
    transition: var(--transition);
}

.btn-outline-primary:hover {
    background-color: rgba(67, 97, 238, 0.1);
}
    </style>
</head>

<body>

    <!-- Back Button -->
   <a href="{{ route('user.services', ['id' => $service->mechanic_id]) }}" class="back-btn">
    <i class="fas fa-arrow-left"></i> Back
</a>

    <!-- Hero Section -->
    <div class="hero">
        <img src="{{ $service->image ? asset('upload/' . $service->image) : asset('img/default_service.jpg') }}" 
             alt="{{ $service->name }}" class="hero-img">
        <div class="hero-content">
            <h1 class="hero-title">{{ $service->name }}</h1>
            <div class="hero-price">₱{{ number_format($service->price, 2) }}</div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <!-- Service Details Section -->
 
        <div class="service-details-section">
                   @if(session('error'))
    <div class="alert alert-danger mt-4 text-center">
        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success mt-4 text-center">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

            <h2 class="section-title">Service Details</h2>
            <p class="service-description">{{ $service->description }}</p>
            
            <!-- Book Now Button -->
            <div class="text-center mt-5">
                @auth
                    <button type="button" class="btn btn-book px-5 py-3" data-bs-toggle="modal" data-bs-target="#bookingModal">
                        <i class="fas fa-calendar-check me-2"></i> Book Now
                    </button>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Please <a href="{{ route('login') }}" class="alert-link">login</a> to book this service.
                    </div>
                @endauth
            </div>
        </div>

        <!-- Rating Section -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="rating-container">
                    @if ($averageRating)
                        <div class="average-rating">{{ number_format($averageRating, 1) }}</div>
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($averageRating))
                                    <i class="fas fa-star star-filled"></i>
                                @else
                                    <i class="far fa-star star-empty"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="review-count">Based on {{ $serviceRatings->count() }} reviews</div>
                    @else
                        <div class="text-center">
                            <i class="fas fa-star star-empty" style="font-size: 3rem;"></i>
                            <div class="mt-3">No ratings yet</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="section-title">Customer Reviews</h2>
                
                @forelse ($serviceRatings as $rating)
                    <div class="review-card">
                        <div class="review-header">
                            <div class="avatar">
                                {{ strtoupper(substr($rating->user->first_name, 0, 1)) }}
                            </div>
                            <div class="review-user">
                                <div class="review-user-name">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</div>
                                <div class="review-date">{{ $rating->created_at->format('F j, Y') }}</div>
                            </div>
                            <div class="review-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating->rating)
                                        <i class="fas fa-star star-filled"></i>
                                    @else
                                        <i class="far fa-star star-empty"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        
                        <p class="review-comment">"{{ $rating->comment ?? 'No comment provided.' }}"</p>
                        
                        @if($rating->image)
                            <img src="{{ asset('upload/review_images/' . $rating->image) }}" 
                                 alt="Review Image" 
                                 class="review-image img-fluid">
                        @endif
                    </div>
                @empty
                    <div class="no-reviews">
                        <div class="no-reviews-icon">
                            <i class="far fa-comment-dots"></i>
                        </div>
                        <h4 class="no-reviews-text">No reviews yet for this service</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('user.bookings.store', $service->id) }}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="booking_time" id="selected_time">
            
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Book Service</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label for="booking_date" class="form-label">Booking Date</label>
                    <input type="date" id="booking_date" name="booking_date" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Available Time Slots</label>
                    <div class="time-slots-container">
                        <div class="row">
                            <!-- Morning Slots -->
                            <div class="col-md-6 mb-3">
                                <h6 class="time-slot-heading">Morning</h6>
                                <div class="btn-group-vertical w-100" role="group">
                                    <input type="radio" class="btn-check" name="time_slot" id="slot1" value="08:00" autocomplete="off">
                                    <label class="btn btn-outline-primary mb-2" for="slot1">8:00 AM</label>
                                    
                                    <input type="radio" class="btn-check" name="time_slot" id="slot2" value="10:00" autocomplete="off">
                                    <label class="btn btn-outline-primary mb-2" for="slot2">10:00 AM</label>
                                </div>
                            </div>
                            
                            <!-- Afternoon Slots -->
                            <div class="col-md-6 mb-3">
                                <h6 class="time-slot-heading">Afternoon</h6>
                                <div class="btn-group-vertical w-100" role="group">
                                    <input type="radio" class="btn-check" name="time_slot" id="slot3" value="13:00" autocomplete="off">
                                    <label class="btn btn-outline-primary mb-2" for="slot3">1:00 PM</label>
                                    
                                    <input type="radio" class="btn-check" name="time_slot" id="slot4" value="15:00" autocomplete="off">
                                    <label class="btn btn-outline-primary mb-2" for="slot4">3:00 PM</label>
                                    
                                    <input type="radio" class="btn-check" name="time_slot" id="slot4" value="15:00" autocomplete="off">
                                    <label class="btn btn-outline-primary mb-2" for="slot4">5:00 PM</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="reason" class="form-label">Special Requests (Optional)</label>
                    <textarea id="reason" name="reason" class="form-control" rows="3" placeholder="Any specific requirements or notes..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submitBookingBtn">
                    <span id="submitText">Confirm Booking</span>
                    <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>
</div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    // Set today's date as minimum booking date
    let today = new Date();
    let tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    
    // Format as YYYY-MM-DD
    let minDate = tomorrow.toISOString().split('T')[0];
    document.getElementById("booking_date").setAttribute("min", minDate);
    
    // Set default time to first available slot
    document.getElementById("selected_time").value = "08:00";
    
    // Handle time slot selection
    document.querySelectorAll('input[name="time_slot"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('selected_time').value = this.value;
        });
    });
    
    // Form submission handling
    const bookingForm = document.querySelector('#bookingModal form');
    const submitBtn = document.getElementById('submitBookingBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');
    
    bookingForm.addEventListener('submit', function(e) {
        // Validate time slot is selected
        const timeSlotSelected = document.querySelector('input[name="time_slot"]:checked');
        if (!timeSlotSelected) {
            e.preventDefault();
            alert('Please select a time slot for your booking.');
            return;
        }
        
        submitBtn.disabled = true;
        submitText.textContent = 'Processing...';
        submitSpinner.classList.remove('d-none');
    });
});
    </script>
</body>
</html>