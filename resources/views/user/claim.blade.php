<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To Claim - Carcare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- External Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

    <style>
        /* Include the full style block from "To Pay" */
        body {
            font-family: 'Roboto', sans-serif;
            background: #ffffff;
        }
        .container {
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 0.75rem;
            transition: all 0.3s;
            position: relative;
        }
        .nav-tabs .nav-link.active {
            color: #4361ee;
            background-color: transparent;
        }
        .nav-tabs .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: #4361ee;
        }
        .nav-tabs .nav-link:hover:not(.active) {
            color: #4361ee;
        }
        .page-header h2 {
            font-size: 1.8rem;
            position: relative;
            display: inline-block;
        }
        .page-header h2:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #4361ee;
            border-radius: 3px;
        }
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .order-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
        }
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: #4361ee;
        }
        .order-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
        }
        .order-badge .badge {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            text-transform: uppercase;
        }
        .order-image-container {
            height: 180px;
            overflow: hidden;
            position: relative;
        }
        .order-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .order-card:hover .order-image {
            transform: scale(1.05);
        }
        .order-content {
            padding: 1.25rem;
        }
        .shop-name {
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }
        .product-name {
            font-size: 1rem;
            margin-bottom: 0.75rem;
            color: #343a40;
        }
        .product-quantity {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .product-price {
            font-size: 1.1rem;
        }
        .order-message {
            font-size: 0.8rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <x-usersidebar />

    <div class="container" style="margin-top: 100px">
        <div class="page-header text-center mb-4">
            <h2 class="font-weight-bold text-primary">Ready for Pickup</h2>
            <p class="text-muted">Your orders that are ready to be collected</p>
        </div>

        <!-- Navigation Tabs -->
        @php
            $pendingCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'pending')->count();
            $claimCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'claim')->count();
            $completedCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'completed')->count();
            $cancelledCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'denied')->count();
            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
        @endphp

<ul class="nav nav-tabs nav-fill mb-4">
    <li class="nav-item">
                <a class="nav-link" href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-cart mr-2"></i> Cart
                    @if($cartCount > 0)
                        <span class="badge badge-pill badge-primary ml-1">{{ $cartCount }}</span>
                    @endif
                </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.pending') }}">
            <i class="fas fa-wallet mr-2"></i> Reserve
            @if($pendingCount > 0)
                <span class="badge badge-pill badge-warning ml-1">{{ $pendingCount }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('user.claim') }}">
            <i class="fas fa-box-open mr-2"></i> Pick Up
            @if($claimCount > 0)
                <span class="badge badge-pill badge-info ml-1">{{ $claimCount }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.completed') }}">
            <i class="fas fa-check-circle mr-2"></i> Completed
            @if($completedCount > 0)
                <span class="badge badge-pill badge-success ml-1">{{ $completedCount }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.denied') }}">
            <i class="fas fa-times-circle mr-2"></i> Cancelled
            @if($cancelledCount > 0)
                <span class="badge badge-pill badge-danger ml-1">{{ $cancelledCount }}</span>
            @endif
        </a>
    </li>
</ul>


        @if($orders->isEmpty())
            <div class="empty-state text-center py-5">
                <div class="empty-icon mb-3">
                    <i class="fas fa-box-open fa-3x text-muted"></i>
                </div>
                <h4 class="text-muted">No Orders Ready for Pickup</h4>
                <p class="text-muted">You don't have any orders ready for collection at this time.</p>
            </div>
        @else
            <div class="orders-grid">
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-badge">
                            <span class="badge badge-info">Ready for Pickup</span>
                        </div>

                        @php $firstItem = $order->items->first(); @endphp
                        <div class="order-image-container">
                            @if($firstItem && $firstItem->product && $firstItem->product->image)
                                <img src="{{ asset('upload/' . $firstItem->product->image) }}" alt="{{ $firstItem->product->ProductName }}" class="order-image">
                            @else
                                <img src="{{ asset('assets/img/default-product.jpg') }}" alt="Default Product" class="order-image">
                            @endif
                        </div>

                        <div class="order-content">
                            @if($firstItem && $firstItem->product && $firstItem->product->mechanic)
                                <div class="order-shop-info mb-2">
                                    <h5 class="shop-name">
                                        <i class="fas fa-store text-primary mr-2"></i>
                                        {{ $firstItem->product->mechanic->shopname }}
                                    </h5>
                                    <p class="shop-address text-muted small">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        {{ $firstItem->product->mechanic->Address }}
                                    </p>
                                </div>
                            @endif

                            <div class="order-product-info">
                                <h6 class="product-name font-weight-bold">{{ $firstItem && $firstItem->product ? $firstItem->product->ProductName : 'Unknown Product' }}</h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="product-quantity">
                                        <i class="fas fa-layer-group text-muted mr-1"></i>
                                        {{ $order->items->sum('quantity') }} item(s)
                                    </span>
                                    <span class="product-price font-weight-bold text-primary">
                                        ₱{{ number_format($order->total_amount, 2) }}
                                    </span>
                                </div>
                            </div>

                            @if($order->status_msg)
                                <div class="order-message alert alert-info p-2 small">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    {{ ucfirst($order->status_msg) }}
                                </div>
                            @endif

                            <div class="order-actions">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-eye mr-1"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>
</body>
</html>
