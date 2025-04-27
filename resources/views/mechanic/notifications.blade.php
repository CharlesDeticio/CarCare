<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mechanic Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
        }

        .container {
            max-width: 800px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            background-color: #007BFF;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .back-button i {
            margin-right: 8px;
        }

        h2 {
            color: #2e1ec2;
            font-weight: 600;
        }

        .notification-card {
            display: flex;
            align-items: flex-start;
            background-color: #fff;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .notification-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .notification-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
        }

        .notification-text {
            flex-grow: 1;
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .notification-header strong {
            font-size: 1.1rem;
            color: #333;
        }

        .notification-message {
            margin-bottom: 5px;
            color: #555;
        }

        .timestamp {
            font-size: 0.85rem;
            color: #999;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .text-muted-center {
            text-align: center;
            color: #777;
            margin-top: 40px;
            font-size: 1.1rem;
        }

        .pagination {
            justify-content: center;
            margin-top: 30px;
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

    <div class="container py-5">

        <!-- Back Button -->
        <a href="{{ route('mechanic.overview') }}" class="back-button mb-3">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>

        <!-- Page Title -->
        <h2 class="text-center mb-4">Mechanic Notifications</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($notifications->isEmpty())
            <p class="text-muted-center">No new notifications.</p>
        @else
            @foreach($notifications as $notification)
                @php
                    $service = $notification->service;
                    $product = $notification->product;

                    $productRating = $notification->productRating ?? null;
                    $serviceRating = $notification->serviceRating ?? null;

                    $isProductRated = isset($notification->product_rating_id) && $productRating;
                    $isServiceRated = isset($notification->service_rating_id) && $serviceRating;

                    $isEmergencyBooking = $notification->type === 'emergency_booking';

                    $image = null;

                    if ($service && $service->image) {
                        $image = asset('upload/' . $service->image);
                    } elseif ($product && $product->image) {
                        $image = asset('upload/' . $product->image);
                    }


                    $name = '';

                    if ($isEmergencyBooking) {
                        $name = ''; // Don’t show name for emergency bookings
                    } elseif ($service) {
                        $name = $service->name;
                    } elseif ($product) {
                        $name = $product->ProductName ?? '';
                    }


                    $isPending = \Illuminate\Support\Str::contains(strtolower($notification->message), 'pending');
                @endphp

                <div class="notification-card d-flex justify-content-between align-items-start">
                    @if ($isEmergencyBooking)
                        <div class="notification-image d-flex align-items-center justify-content-center"
                            style="width: 70px; height: 70px; border-radius: 10px; background-color: #dc3545; color: white; font-size: 1.8rem;">
                            🚨
                        </div>
                    @elseif (!is_null($image))
                        <img src="{{ $image }}" alt="{{ $name }}" class="notification-image">
                    @endif



                    <div class="notification-text flex-grow-1 me-3">
                        <div class="notification-header">
                            @if (!empty($name))
                                <strong>{{ $name }}</strong>
                            @endif

                            @if($isPending)
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </div>

                        <div class="notification-message">
                            {{ $notification->message }}

                            @if ($isProductRated)
                                <p class="mb-1 mt-1"><strong>Rated:</strong>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $productRating->rating ? '' : '-o' }}"
                                            style="color: #ffc107;"></i>
                                    @endfor
                                </p>
                            @endif

                            @if ($isServiceRated)
                                <p class="mb-1 mt-1"><strong>Rated:</strong>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $serviceRating->rating ? '' : '-o' }}"
                                            style="color: #ffc107;"></i>
                                    @endfor
                                </p>
                            @endif
                        </div>

                        <div class="timestamp">
                            {{ $notification->created_at->format('F j, Y h:i A') }} &bull;
                            {{ $notification->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <form method="POST" action="{{ route('mechanic.notifications.delete', $notification->id) }}"
                        onsubmit="return confirm('Are you sure you want to delete this notification?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Notification">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endforeach

            <div class="pagination-wrapper">
                {{ $notifications->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>