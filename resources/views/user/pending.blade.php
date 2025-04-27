<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>To Pay - Carcare</title>

    <!-- External Styles -->
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #ffffff;
        }

        /* Navigation Tabs */
        .nav-tabs {
            font-size: 14px;
        }

        .nav-tabs .nav-item {
            flex: 1;
            text-align: center;
        }

        .nav-tabs .nav-link {
            padding: 10px;
            border: none;
            color: #333;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease-in-out;
        }

        .nav-tabs .nav-link.active {
            border-bottom: 3px solid #070bff;
            font-weight: bold;
            color: #070bff;
        }

        /* Mobile Adjustments */
        @media (max-width: 576px) {
            .nav-tabs {
                font-size: 12px;
            }

            .nav-tabs .nav-link {
                padding: 6px 8px;
            }
        }

        /* Container */
        .container {
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Orders Grid using CSS Grid */
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        /* Order Card Styles */
        .order-card {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Order Image */
        .order-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* Order Details */
        .order-details {
            flex: 1;
        }

        .order-id {
            font-size: 1.1em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .order-status .badge {
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 0.9em;
            color: #fff;
            display: inline-block;
            margin-bottom: 10px;
        }

        .badge-warning {
            background: #f39c12;
        }

        .badge-success {
            background: #28a745;
        }

        .badge-danger {
            background: #dc3545;
        }

        .badge-info {
            background: #17a2b8;
        }

        .badge-primary {
            background: #007bff;
        }

        .order-name,
        .order-amount,
        .order-quantity {
            font-size: 0.95em;
            color: #555;
            margin-bottom: 8px;
        }

        .order-amount {
            font-weight: bold;
            color: #e74c3c;
        }

        /* Remove default link styling */
        .order-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        /* Cancel Order Button */
        .btn-danger {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-danger:hover {
            background: #c0392b;
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

        .empty-state {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
        }

        .empty-icon {
            opacity: 0.6;
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
            letter-spacing: 0.5px;
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

        .order-actions .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .orders-grid {
                grid-template-columns: 1fr;
            }

            .nav-tabs .nav-link {
                font-size: 0.8rem;
                padding: 0.5rem;
            }

            .nav-tabs .nav-link i {
                display: block;
                margin: 0 auto 0.25rem;
                font-size: 1rem;
            }

            .page-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- User Sidebar -->
    <x-usersidebar />

    <div class="container" style="margin-top: 100px">
        <div class="page-header text-center mb-4">
            <h2 class="font-weight-bold text-primary">Reserved Orders</h2>
            <p class="text-muted">Your pending reservations awaiting payment</p>
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
                <a class="nav-link active" href="{{ route('user.pending') }}">
                    <i class="fas fa-wallet mr-2"></i> Reserve
                    @if($orders->count() > 0)
                        <span class="badge badge-pill badge-warning ml-1">{{ $orders->count() }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.claim') }}">
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
                    <i class="fas fa-wallet fa-3x text-muted"></i>
                </div>
                <h4 class="text-muted">No Pending Reservations</h4>
                <p class="text-muted">You don't have any orders waiting for payment.</p>
            </div>
        @else
            <div class="orders-grid">
                @foreach($orders as $order)
                        <div class="order-card">
                            <div class="order-badge">
                                <span class="badge 
                                            @if($order->status === 'pending') badge-warning
                                            @elseif($order->status === 'accepted') badge-success
                                            @elseif($order->status === 'denied') badge-danger
                                            @elseif($order->status === 'claim') badge-info
                                            @elseif($order->status === 'completed') badge-primary
                                            @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            @php
                                $firstItem = $order->items->first();
                            @endphp

                            <div class="order-image-container">
                                @if($firstItem && $firstItem->product && $firstItem->product->image)
                                    <img src="{{ asset('upload/' . $firstItem->product->image) }}"
                                        alt="{{ $firstItem->product->ProductName }}" class="order-image">
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
                                    </div>
                                @endif

                                <div class="order-product-info">
                                    <h6 class="product-name font-weight-bold">
                                        {{ $firstItem && $firstItem->product ? $firstItem->product->ProductName : 'Unknown Product' }}
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="product-quantity">
                                            <i class="fas fa-layer-group text-muted mr-1"></i>
                                            {{ $order->items->sum('quantity') }} item(s)
                                        </span>
                                        <span class="product-price font-weight-bold text-danger">
                                            ₱{{ number_format($order->total_amount, 2) }}
                                        </span>
                                    </div>
                                </div>

                                @if($order->status_msg)
                                    <div class="order-message alert 
                                                @if($order->status === 'pending') alert-warning
                                                @elseif($order->status === 'accepted') alert-success
                                                @elseif($order->status === 'denied') alert-danger
                                                @elseif($order->status === 'claim') alert-info
                                                @elseif($order->status === 'completed') alert-primary
                                                @endif
                                                p-2 mb-3 small">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        {{ ucfirst($order->status_msg) }}
                                    </div>
                                @endif

                                <div class="order-actions d-flex">
                                    <a href="{{ route('orders.show', $order) }}"
                                        class="btn btn-sm btn-outline-primary flex-grow-1 mr-2">
                                        <i class="fas fa-eye mr-1"></i> Details
                                    </a>
                                    @if($order->status === 'pending')
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="event.stopPropagation(); confirmCancelOrder({{ $order->id }})">
                                            <i class="fas fa-times mr-1"></i> Cancel
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- SweetAlert2 for Cancel Order Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCancelOrder(orderId) {
            event.stopPropagation();

            Swal.fire({
                title: "Select a reason for cancellation",
                html: `
                        <div style="text-align: left;">
                            <label><input type="radio" name="cancelReason" value="Changed my mind"> Changed my mind</label><br>
                            <label><input type="radio" name="cancelReason" value="Found a better deal"> Found a better deal</label><br>
                            <label><input type="radio" name="cancelReason" value="Ordered by mistake"> Ordered by mistake</label><br>
                            <label><input type="radio" name="cancelReason" value="Product no longer needed"> Product no longer needed</label><br>
                            <label><input type="radio" name="cancelReason" value="Other"> Other (Specify below)</label><br>
                            <input type="text" id="otherReason" class="swal2-input" placeholder="Enter reason here..." style="display: none;">
                        </div>
                    `,
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Cancel it!",
                preConfirm: () => {
                    const selectedReason = document.querySelector('input[name="cancelReason"]:checked');
                    let reason = selectedReason ? selectedReason.value : null;

                    if (!reason) {
                        Swal.showValidationMessage("Please select a reason for cancellation.");
                    }

                    if (reason === "Other") {
                        const otherReason = document.getElementById('otherReason').value.trim();
                        if (!otherReason) {
                            Swal.showValidationMessage("Please specify the reason.");
                        }
                        reason = otherReason;
                    }

                    return reason;
                },
                didOpen: () => {
                    document.querySelectorAll('input[name="cancelReason"]').forEach((radio) => {
                        radio.addEventListener("change", function () {
                            const otherReasonInput = document.getElementById("otherReason");
                            otherReasonInput.style.display = (this.value === "Other") ? "block" : "none";
                        });
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Cancelling...',
                        text: 'Please wait while we process your request.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch("{{ route('user.cancelOrder') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            order_id: orderId,
                            reason: result.value
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Cancelled',
                                    text: 'Your order has been successfully cancelled.',
                                    timer: 1800,
                                    showConfirmButton: false
                                }).then(() => location.reload());
                            } else {
                                Swal.fire("Error!", data.message || "Something went wrong.", "error");
                            }
                        })
                        .catch(() => {
                            Swal.fire("Error!", "Failed to cancel the order. Try again.", "error");
                        });
                }
            });
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>
</body>

</html>