<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shop Reviews & Ratings | Carcare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Boxicons (Optional for icons) -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">

    <style>
        body {
            background-color: #f8fafc;
            color: #334155;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .section-title {
            color: #1e40af;
            font-weight: 700;
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #10b981);
            border-radius: 2px;
        }

        .container {
            max-width: 1100px;
            margin-left: 310px;
            margin-top: 60px;
            padding-bottom: 50px;
        }

        .review-section {
            background-color: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
            border: 1px solid rgba(226, 232, 240, 0.7);
            transition: all 0.3s ease;
        }

        .review-section:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .review-header {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e40af;
            padding-bottom: 15px;
            margin-bottom: 25px;
            position: relative;
            display: flex;
            align-items: center;
        }

        .review-header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #10b981);
            border-radius: 3px;
        }

        .review-header i {
            margin-right: 12px;
            font-size: 1.3rem;
            color: #3b82f6;
        }

        .review-card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            background-color: #f8fafc;
            position: relative;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
        }

        .review-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, #3b82f6, #10b981);
        }

        .review-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #10b981);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .review-date {
            font-size: 0.875rem;
            color: #64748b;
        }

        .star-rating i {
            color: #f59e0b;
            font-size: 1.1rem;
        }

        .star-rating .empty-star {
            color: #cbd5e1;
        }

        .comment-text {
            color: #475569;
            font-size: 0.95rem;
            margin-top: 15px;
            line-height: 1.6;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            border-left: 3px solid #3b82f6;
            position: relative;
        }

        .comment-text:before {
            content: '"';
            position: absolute;
            top: 5px;
            left: 8px;
            font-size: 32px;
            color: #e2e8f0;
            font-family: serif;
            line-height: 1;
            z-index: 0;
        }

        .comment-text p {
            position: relative;
            z-index: 1;
            margin: 0;
        }

        .no-reviews {
            text-align: center;
            color: #94a3b8;
            padding: 40px 0;
            font-style: italic;
            background-color: #f8fafc;
            border-radius: 12px;
            border: 1px dashed #cbd5e1;
        }

        .no-reviews i {
            font-size: 2rem;
            margin-bottom: 15px;
            color: #cbd5e1;
            display: block;
        }

        .badge {
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
        }

        .badge.bg-primary {
            background-color: #3b82f6 !important;
        }

        .badge.bg-success {
            background-color: #10b981 !important;
        }

        /* Tab Navigation */
        .review-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            border-bottom: none;
        }

        .review-tab {
            padding: 12px 25px;
            margin: 0 10px;
            font-weight: 600;
            color: #64748b;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
        }

        .review-tab i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .review-tab.active {
            color: #3b82f6;
            background-color: #eff6ff;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.1);
        }

        .review-tab:hover:not(.active) {
            color: #1e40af;
            background-color: #f1f5f9;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 1200px) {
            .container {
                margin-left: 280px;
            }
        }

        @media (max-width: 992px) {
            .container {
                margin-left: 0;
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 768px) {
            .user-info {
                flex-direction: row;
                align-items: center;
            }
            
            .review-card {
                padding: 15px;
            }
            
            .review-tabs {
                flex-direction: column;
                align-items: center;
            }
            
            .review-tab {
                width: 100%;
                max-width: 300px;
                margin: 5px 0;
                justify-content: center;
            }
        }
        .badge small {
    font-size: 0.7em;
    opacity: 0.8;
}

        /* Animation */
        .review-card {
            animation: fadeIn 0.4s ease forwards;
        }

        .review-card:nth-child(1) { animation-delay: 0.1s; }
        .review-card:nth-child(2) { animation-delay: 0.2s; }
        .review-card:nth-child(3) { animation-delay: 0.3s; }
        .review-card:nth-child(4) { animation-delay: 0.4s; }
        .review-card:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <x-sidebar />
    </div>

    <div class="container py-5">
        <h2 class="text-center section-title mb-5">User Reviews & Ratings</h2>

        <!-- Tab Navigation -->
        <div class="review-tabs">
            <button class="review-tab active" onclick="showTab('product-reviews')">
                <i class="fas fa-box-open"></i> Product Reviews
            </button>
            <button class="review-tab" onclick="showTab('service-reviews')">
                <i class="fas fa-tools"></i> Service Reviews
            </button>
            <!--<button class="review-tab" onclick="showTab('emergency-reviews')">-->
            <!--    <i class="fas fa-ambulance"></i> Emergency Reviews-->
            <!--</button>-->
        </div>
        

        <!-- Product Reviews Tab -->
        <div id="product-reviews" class="tab-content active">
            <div class="review-section">
                <div class="review-header"><i class="fas fa-box-open me-2"></i> Product Reviews</div>

                @if($productRatings->isEmpty())
                    <div class="no-reviews">
                        <i class="fas fa-box-open"></i>
                        No product reviews yet.
                    </div>
                @else
                    @foreach($productRatings as $rating)
                        <div class="card review-card p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="user-info">
                                    <div class="review-avatar">
                                        {{ strtoupper(substr($rating->user->first_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</div>
                                        <div class="review-date">{{ $rating->created_at->format('F d, Y') }}</div>
                                    </div>
                                </div>

                                <div class="text-end">
    <span class="badge bg-primary">
        <i class="fas fa-box me-1"></i>
        {{ $rating->product->ProductName }}
        <small class="ms-1">(ID: {{ strtoupper(substr($rating->order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3)) }}{{ date('Ymd', strtotime($rating->order->created_at)) }}{{ substr(md5($rating->order->id), 0, 6) }})</small>
    </span>
</div>
                            </div>

                            <div class="mt-3 star-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star empty-star"></i>
                                    @endif
                                @endfor
                                <small class="ms-2 text-muted">({{ $rating->rating }}/5)</small>
                            </div>

                            <div class="comment-text">
                                <p>{{ $rating->comment ?? 'No comment provided.' }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Service Reviews Tab -->
        
        <!-- Service Reviews Tab -->
<div id="service-reviews" class="tab-content">
    <div class="review-section">
        <div class="review-header"><i class="fas fa-tools me-2"></i> Service Reviews</div>

        @if($serviceRatings->isEmpty())
            <div class="no-reviews">
                <i class="fas fa-tools"></i>
                No service reviews yet.
            </div>
        @else
            @foreach($serviceRatings as $rating)
                <div class="card review-card p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="user-info">
                            <div class="review-avatar">
                                {{ strtoupper(substr($rating->user->first_name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="user-name">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</div>
                                <div class="review-date">{{ $rating->created_at->format('F d, Y') }}</div>
                            </div>
                        </div>

                        <div class="text-end">
                            @php
                                $shopInitials = strtoupper(substr($rating->booking->mechanic->shopname ?? 'CAR', 0, 3));
                                $datePart = $rating->booking->created_at->format('Ymd');
                                $randomPart = substr(md5($rating->booking->id), 0, 6);
                                $bookingReference = $shopInitials . $datePart . $randomPart;
                            @endphp
                            <span class="badge bg-success">
                                <i class="fas fa-tools me-1"></i>
                                {{ $rating->service->name }}
                                <small class="ms-1">(ID: {{ $bookingReference }})</small>
                            </span>
                        </div>
                    </div>

                    <div class="mt-3 star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star empty-star"></i>
                            @endif
                        @endfor
                        <small class="ms-2 text-muted">({{ $rating->rating }}/5)</small>
                    </div>

                    <div class="comment-text">
                        <p>{{ $rating->comment ?? 'No comment provided.' }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
        <!-- Emergency Reviews Tab -->
<div id="emergency-reviews" class="tab-content">
    <div class="review-section">
        <div class="review-header"><i class="fas fa-ambulance me-2"></i> Emergency Reviews</div>

        @if($emergencyRatings->isEmpty())
            <div class="no-reviews">
                <i class="fas fa-ambulance"></i>
                No emergency booking reviews yet.
            </div>
        @else
            @foreach($emergencyRatings as $rating)
                <div class="card review-card p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="user-info">
                            <div class="review-avatar">
                                {{ strtoupper(substr($rating->user->first_name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="user-name">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</div>
                                <div class="review-date">{{ $rating->created_at->format('F d, Y') }}</div>
                            </div>
                        </div>

                        <div class="text-end">
                            <span class="badge bg-danger"><i class="fas fa-car-crash me-1"></i>Booking EMB{{ $rating->emergency_booking_id }}</span>
                        </div>
                    </div>

                    <div class="mt-3 star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star empty-star"></i>
                            @endif
                        @endfor
                        <small class="ms-2 text-muted">({{ $rating->rating }}/5)</small>
                    </div>

                    <div class="comment-text">
                        <p>{{ $rating->comment ?? 'No comment provided.' }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>


    </div>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="{{ asset('assets/js/script2.js') }}"></script>

    <script>
        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.review-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show the selected tab content
            document.getElementById(tabId).classList.add('active');
            
            // Add active class to the clicked tab
            event.currentTarget.classList.add('active');
        }
    </script>

</body>

</html>