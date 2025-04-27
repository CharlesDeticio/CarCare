<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notifications - Carcare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
        }

        .container {
            margin-top: 120px;
            background: #fff;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            max-width: 900px;
        }

        h2 {
            color: #2e1ec2;
            font-weight: 600;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            background-color: #007bff;
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .back-button i {
            margin-right: 8px;
        }

        .notification-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 18px 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .notification-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .notification-content {
            display: flex;
            align-items: center;
            flex: 1;
            gap: 15px;
        }

        .notification-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        .notification-text {
            flex-grow: 1;
        }

        .notification-text strong {
            font-size: 1.1rem;
            color: #333;
        }

        .notification-text p {
            margin: 4px 0;
            color: #666;
        }

        .timestamp {
            font-size: 0.85rem;
            color: #999;
        }

        .mark-as-read {
            color: #dc3545;
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .mark-as-read:hover {
            color: #a71d2a;
        }

        .text-muted-center {
            text-align: center;
            color: #777;
            margin-top: 40px;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .notification-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .notification-content {
                width: 100%;
            }

            .mark-as-read {
                align-self: flex-end;
                margin-top: 10px;
            }
        }

        /* Optional styling for pagination */
        .pagination-container .btn {
            min-width: 100px;
        }

        .siren-icon {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-usersidebar />

    <!-- Content Container -->
    <div class="container">

        <!-- Back Button -->
        <a href="{{ route('dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <!-- Page Title -->
        <h2 class="text-center mb-4">Notifications</h2>

        @if($notifications->isEmpty())
            <p class="text-muted-center">No new notifications.</p>
        @else
            @foreach($notifications as $notification)
                @php
                    $isProductRated = isset($notification->product_rating_id) && $notification->productRating;
                    $isServiceRated = isset($notification->service_rating_id) && $notification->serviceRating;

                    $ratingObj = $isProductRated ? $notification->productRating : ($isServiceRated ? $notification->serviceRating : null);

                    $product = $notification->product;
                    $booking = $notification->booking ?? null;
                    $service = $booking?->service ?? $notification->service ?? null;

                    $isProductNotification = $product && !is_null($product->id);
                    $isServiceNotification = !$isProductNotification && $service && !is_null($service->id);
                    $isEmergencyBooking = $notification->type === 'emergency_booking';

                    $image = null;

                    if ($isProductNotification && $product->image) {
                        $image = asset('upload/' . $product->image);
                    } elseif ($isServiceNotification && $service->image) {
                        $image = asset('upload/' . $service->image);
                    }

                    $name = '';
                    if ($isEmergencyBooking) {
                        $name = ''; // Don't display name for emergency booking
                    } elseif ($isProductNotification) {
                        $name = $product->ProductName ?? 'Unknown Product';
                    } elseif ($isServiceNotification) {
                        $name = $service->name ?? 'Unknown Service';
                    }

                    $mechanic = $isProductNotification
                        ? ($product->mechanic ?? null)
                        : ($service?->mechanic ?? null);
                @endphp

                <div class="notification-card" id="notification-{{ $notification->id }}">
                    <div class="notification-content">
                        <!-- IMAGE -->
                        @if ($isEmergencyBooking)
                            <div class="notification-image d-flex align-items-center justify-content-center"
                                style="width: 70px; height: 70px; border-radius: 10px; background-color: #dc3545; color: white; font-size: 1.8rem;">
                                🚨
                            </div>
                        @elseif (!is_null($image))
                            <img src="{{ $image }}" alt="{{ $name }}" class="notification-image">
                        @endif


                        <!-- TEXT -->
                        <div class="notification-text">
                            @if(!empty($name))
                                <strong>{{ $name }}</strong>
                            @endif

                            {{-- ⭐ Display rating only for the user who rated --}}
                            @if (($isProductRated || $isServiceRated) && $ratingObj)
                                @if ($notification->user_id === auth()->id())
                                    <p class="mb-1">
                                        <strong>Rating:</strong>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $ratingObj->rating ? '' : '-o' }}" style="color: #ffc107;"></i>
                                        @endfor
                                    </p>
                                    @if (!empty($ratingObj->comment))
                                        <p class="mb-1"><em>"{{ $ratingObj->comment }}"</em></p>
                                    @endif
                                @endif
                                <p class="mb-1">{{ $notification->message }}</p>
                            @elseif($isEmergencyBooking)
                                <p class="mb-1 text-danger">{{ $notification->message ?? 'Emergency booking notification' }}</p>
                            @else
                                @if ($mechanic)
                                    <p class="mb-1"><i class="fas fa-tools"></i> {{ $mechanic->shopname ?? 'Unknown Mechanic' }}</p>
                                @endif
                                <p class="mb-1">{{ $notification->message }}</p>
                            @endif

                            <div class="timestamp">
                                {{ $notification->created_at->format('F j, Y h:i A') }} &bull;
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <!-- MARK AS READ -->
                    <span class="mark-as-read" onclick="markAsRead({{ $notification->id }})" title="Mark as read">
                        <i class="fas fa-times-circle"></i>
                    </span>
                </div>
            @endforeach

            <!-- Pagination Buttons -->
            @if ($notifications->hasPages())
                <div class="pagination-container d-flex justify-content-center mt-4">
                    @if ($notifications->onFirstPage())
                        <button class="btn btn-secondary mr-2" disabled>Previous</button>
                    @else
                        <a href="{{ $notifications->previousPageUrl() }}" class="btn btn-primary mr-2">Previous</a>
                    @endif

                    <span class="align-self-center">Page {{ $notifications->currentPage() }} of
                        {{ $notifications->lastPage() }}</span>

                    @if ($notifications->hasMorePages())
                        <a href="{{ $notifications->nextPageUrl() }}" class="btn btn-primary ml-2">Next</a>
                    @else
                        <button class="btn btn-secondary ml-2" disabled>Next</button>
                    @endif
                </div>
            @endif

        @endif

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>

    <script>
        function markAsRead(notificationId) {
            fetch("{{ route('notifications.markAsRead', '') }}/" + notificationId, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let notificationElement = document.getElementById("notification-" + notificationId);
                        if (notificationElement) {
                            notificationElement.remove();
                        }
                    } else {
                        alert("Failed to mark notification as read.");
                    }
                })
                .catch(() => {
                    alert("Something went wrong.");
                });
        }
    </script>

</body>

</html>