<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - Carcare</title>
    
    <!-- External Styles -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
            max-width: 300px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
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

        .badge-warning { background: #f39c12; }
        .badge-success { background: #28a745; }
        .badge-danger { background: #dc3545; }
        .badge-info { background: #17a2b8; }
        .badge-primary { background: #007bff; }

        .order-name, .order-amount, .order-quantity {
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
        
        /* Cart specific styles */
        .quantity-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
        }
        
        .quantity-controls button {
            background-color: #4361ee;
            color: #fff;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 5px;
        }
        
        .quantity-display {
            min-width: 40px;
            text-align: center;
        }
        
        .btn-remove {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        
        .select-checkbox {
            position: absolute;
            top: 10px;
            left: 10px;
            transform: scale(1.3);
            z-index: 2;
        }
        
        .checkout-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            position: relative;
        }
        
        .checkout-footer .total {
            font-weight: bold;
            font-size: 18px;
        }
        
        .btn-checkout {
            background-color: #4361ee;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-checkout:hover {
            background-color: #3a56d4;
        }
        
        .btn-checkout:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        /* Out of stock styles */
        .out-of-stock {
            position: relative;
        }

        .out-of-stock:after {
            content: "Out of Stock";
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            z-index: 1;
        }

        .out-of-stock .order-image {
            opacity: 0.6;
            filter: grayscale(50%);
        }

        .out-of-stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
            background-color: #dc3545;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .checkout-disabled:after {
            content: "Cannot checkout with out-of-stock items";
            position: absolute;
            bottom: -25px;
            left: 0;
            width: 100%;
            color: #dc3545;
            font-size: 0.8rem;
        }

        .inventory-warning {
            color: #dc3545;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .inventory-available {
            color: #28a745;
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
        .quantity-input {
    width: 50px;
    text-align: center;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin: 0 5px;
    font-weight: bold;
}

.quantity-controls button {
    background-color: #4361ee;
    color: #fff;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}

.quantity-controls button:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
}
    </style>
</head>

<body>
    <!-- User Sidebar -->
    <x-usersidebar />

    <div class="container" style="margin-top: 100px">
        <div class="page-header text-center mb-4">
            <h2 class="font-weight-bold text-primary">Your Cart</h2>
            <p class="text-muted">Items you've selected for purchase</p>
        </div>

        @php
            $pendingCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'pending')->count();
            $claimCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'claim')->count();
            $completedCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'completed')->count();
            $deniedCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'denied')->count();
            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
        @endphp

        <ul class="nav nav-tabs nav-fill mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('cart.index') }}">
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
                    @if($deniedCount > 0)
                        <span class="badge badge-pill badge-danger ml-1">{{ $deniedCount }}</span>
                    @endif
                </a>
            </li>
        </ul>

        @if($cartItems->isEmpty())
            <div class="empty-state text-center py-5">
                <div class="empty-icon mb-3">
                    <i class="fas fa-shopping-cart fa-3x text-muted"></i>
                </div>
                <h4 class="text-muted">Your Cart is Empty</h4>
                <p class="text-muted">You don't have any items in your cart yet.</p>
                <a href="{{ route('products.all') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-store mr-2"></i> Browse Products
                </a>
            </div>
        @else
            <div class="orders-grid">
                @foreach($cartItems as $item)
                    <div class="order-card @if($item->product->Inventory <= 0) out-of-stock @endif"
                        data-id="{{ $item->id }}"
                        data-price="{{ $item->product->Price }}"
                        data-quantity="{{ $item->quantity }}"
                        data-max="{{ $item->product->Inventory }}">

                        @if($item->product->Inventory <= 0)
                            <span class="out-of-stock-badge">Out of Stock</span>
                        @endif
                        
                        <input type="checkbox" class="select-checkbox item-select" 
                               @if($item->product->Inventory > 0) checked @else disabled @endif>
                        
                        <div class="order-image-container">
                            <img src="{{ $item->product->image ? asset('upload/' . $item->product->image) : asset('assets/img/default-product.jpg') }}" 
                                 alt="{{ $item->product->ProductName }}" 
                                 class="order-image">
                        </div>
                        
                        <div class="order-content">
                            @if($item->product->mechanic)
                                <div class="order-shop-info mb-2">
                                    <h5 class="shop-name">
                                        <i class="fas fa-store text-primary mr-2"></i>
                                        {{ $item->product->mechanic->shopname }}
                                    </h5>
                                </div>
                            @endif
                            
                            <div class="order-product-info">
                                <h6 class="product-name font-weight-bold">{{ $item->product->ProductName }}</h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="product-price font-weight-bold @if($item->product->Inventory <= 0) text-muted @else text-danger @endif">
                                        ₱{{ number_format($item->product->Price * $item->quantity, 2) }}
                                    </span>
                                    @if($item->product->Inventory > 0)
                                        <small class="inventory-available">
                                            {{ $item->product->Inventory }} available
                                        </small>
                                    @else
                                        <small class="inventory-warning">
                                            Out of stock
                                        </small>
                                    @endif
                                </div>
                            </div>
                            
                            @if($item->product->Inventory > 0)
                                <!-- Replace the quantity controls section in your cart items with this: -->
<div class="quantity-controls">
    <form action="{{ route('cart.decrement', ['cart' => $item->id]) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
    </form>
    
    <form action="{{ route('cart.update', ['cart' => $item->id]) }}" method="POST" class="d-inline quantity-form">
        @csrf
        @method('PUT')
        <input type="number" 
               name="quantity" 
               class="quantity-input" 
               value="{{ $item->quantity }}" 
               min="1" 
               max="{{ $item->product->Inventory }}"
               onchange="this.form.submit()"
               {{ $item->product->Inventory <= 0 ? 'disabled' : '' }}>
    </form>
    
    <form action="{{ route('cart.increment', ['cart' => $item->id]) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" {{ $item->quantity >= $item->product->Inventory ? 'disabled' : '' }}>+</button>
    </form>
</div>
                            @endif
                            
                            <form action="{{ route('cart.destroy', ['cart' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove">
                                    <i class="fas fa-trash-alt mr-1"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Checkout Footer Form -->
            <form id="checkout-form" action="{{ route('payments.index') }}" method="POST">
                @csrf
                <input type="hidden" name="selected_items" id="selectedItems">
                <div class="checkout-footer @if($cartItems->contains(fn($item) => $item->product->Inventory <= 0)) checkout-disabled @endif">
                    <div class="total">Total: ₱<span id="cart-total">0.00</span></div>
                    <button type="submit" class="btn-checkout" id="checkout-button">Proceed to Checkout</button>
                </div>
            </form>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script1.js') }}"></script>

    <!-- Replace your existing script section with this: -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // DOM Elements
    const cartCards = document.querySelectorAll('.order-card');
    const totalDisplay = document.getElementById('cart-total');
    const checkoutForm = document.getElementById('checkout-form');
    const selectedItemsInput = document.getElementById('selectedItems');
    const checkoutButton = document.getElementById('checkout-button');
    const checkoutFooter = document.querySelector('.checkout-footer');

    // Initialize cart
    calculateCartTotal();
    updateCheckoutButtonState();

    // Quantity input handlers
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const card = this.closest('.order-card');
            const max = parseInt(card.getAttribute('data-max'));
            const min = 1;
            let value = parseInt(this.value);

            // Validate input
            if (isNaN(value)) value = min;
            if (value < min) value = min;
            if (value > max) value = max;
            
            this.value = value;
            card.setAttribute('data-quantity', value);

            // Update price display
            const price = parseFloat(card.getAttribute('data-price'));
            const priceDisplay = card.querySelector('.product-price');
            priceDisplay.textContent = `₱${(price * value).toFixed(2)}`;

            // Recalculate total and update UI
            calculateCartTotal();
            updateCheckoutButtonState();

            // Submit the form if value changed
            if (value !== parseInt(this.defaultValue)) {
                this.form.submit();
            }
        });
    });

    // Increment/Decrement button handlers
    document.querySelectorAll('.quantity-controls button[type="submit"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const card = this.closest('.order-card');
            const quantityInput = card.querySelector('.quantity-input');
            
            // Update the input value before submitting
            if (this.textContent === '+') {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            } else {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
            
            // Trigger change event to update UI
            quantityInput.dispatchEvent(new Event('change'));
            
            // Submit the form
            form.submit();
        });
    });

    // Checkbox change handlers
    document.querySelectorAll('.item-select').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            calculateCartTotal();
            updateCheckoutButtonState();
        });
    });

    // Form submission handler
    checkoutForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const selectedItemIds = getSelectedItemIds();
        const { hasInvalidItems, invalidItems } = validateItems();

        // Validate selection
        if (selectedItemIds.length === 0) {
            Swal.fire({
                title: 'No Items Selected',
                text: 'Please select at least one item to checkout.',
                icon: 'warning',
                confirmButtonColor: '#4361ee'
            });
            return;
        }

        // Check for invalid items
        if (hasInvalidItems) {
            const message = `The following items are unavailable:\n\n${invalidItems.join('\n')}\n\nPlease remove them before proceeding.`;
            Swal.fire({
                title: 'Invalid Items',
                text: message,
                icon: 'error',
                confirmButtonColor: '#4361ee'
            });
            return;
        }

        // Confirm checkout
        Swal.fire({
            title: 'Confirm Checkout',
            text: 'Are you sure you want to proceed with these items?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4361ee',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Checkout',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                selectedItemsInput.value = selectedItemIds.join(',');
                checkoutForm.submit();
            }
        });
    });

    // Helper functions
    function getSelectedItemIds() {
        const selected = [];
        document.querySelectorAll('.item-select:checked').forEach(checkbox => {
            selected.push(checkbox.closest('.order-card').getAttribute('data-id'));
        });
        return selected;
    }

    function validateItems() {
        const invalidItems = [];
        let hasInvalidItems = false;

        document.querySelectorAll('.item-select:checked').forEach(checkbox => {
            const card = checkbox.closest('.order-card');
            const maxQuantity = parseInt(card.getAttribute('data-max'));
            const currentQuantity = parseInt(card.getAttribute('data-quantity'));
            
            if (maxQuantity <= 0 || currentQuantity > maxQuantity) {
                hasInvalidItems = true;
                invalidItems.push(card.querySelector('.product-name').textContent);
            }
        });

        return { hasInvalidItems, invalidItems };
    }

    function calculateCartTotal() {
        let total = 0;
        document.querySelectorAll('.item-select:checked').forEach(checkbox => {
            const card = checkbox.closest('.order-card');
            const price = parseFloat(card.getAttribute('data-price'));
            const quantity = parseInt(card.getAttribute('data-quantity'));
            total += price * quantity;
        });
        totalDisplay.textContent = total.toFixed(2);
    }

    function updateCheckoutButtonState() {
        const selectedItemIds = getSelectedItemIds();
        const { hasInvalidItems } = validateItems();
        
        const shouldDisable = selectedItemIds.length === 0 || hasInvalidItems;
        checkoutButton.disabled = shouldDisable;
        
        if (shouldDisable) {
            checkoutFooter.classList.add('checkout-disabled');
        } else {
            checkoutFooter.classList.remove('checkout-disabled');
        }
    }
});
</script>
</body>
</html>