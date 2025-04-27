<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - Carcare</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        h1, header {
            text-align: center;
            color: #4361ee;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .section {
            padding: 20px;
            border-radius: 8px;
            background: #f8f9fa;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 15px;
            color: #343a40;
        }

        .user-info span {
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .highlight {
            font-weight: 500;
            color: #212529;
        }

        .order-items {
            margin-top: 15px;
        }

        .order-item {
            display: grid;
            grid-template-columns: 60px auto 100px 100px;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px dashed #ccc;
            gap: 1rem;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }

        .item-info {
            font-weight: 500;
            font-size: 1rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .quantity-display {
            font-weight: 600;
            text-align: center;
            min-width: 30px;
        }

        .item-price, .item-subtotal {
            font-weight: bold;
            color: #e74c3c;
            text-align: right;
        }

        .btn-primary {
            background: #4361ee;
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 6px;
            font-size: 1rem;
            width: 100%;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: #364fc7;
        }

        .total-amount {
            text-align: right;
            font-size: 1.5rem;
            font-weight: bold;
            color: #e74c3c;
        }
        .quantity-input {
            width: 40px;
            padding: 5px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-weight: 600;
        }
        .hidden {
    display: none;
}

    </style>
</head>
<body>
<div class="container">
    <header>Checkout</header>

    <!-- Payment Info -->
    <div class="section">
        <div class="section-title">Payment Information</div>
        <div class="user-info">
            <span><span class="highlight">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span></span>
            <span>📞 Phone: <span class="highlight">{{ auth()->user()->phone_number }}</span></span>
        </div>
    </div>

    <!-- Order Summary -->
    <form action="{{ route('payments.process') }}" method="POST" id="payment-form">
        @csrf
        <div class="section">
            <div class="section-title">Order Summary</div>
            <div class="order-items">
                @if($cartItems->count() > 0)
                    @foreach($cartItems as $item)
                        <div class="order-item"
                             data-id="{{ $item->product->id }}"
                             data-price="{{ $item->product->Price }}"
                             data-max="{{ $item->product->Inventory }}"
                             data-quantity="{{ $item->quantity }}">

                            <img class="item-image" src="{{ $item->product->image ? asset('upload/' . $item->product->image) : asset('assets/img/default-product.jpg') }}" alt="{{ $item->product->ProductName }}">

                            <div class="item-info">
                                {{ $item->product->ProductName }}<br>
                                <small class="text-muted"><i class="fas fa-store mr-1"></i>{{ $item->product->mechanic->shopname ?? 'Unknown Shop' }}</small>
                            </div>

                            @if($isBuyNow)
                                <div class="quantity-controls">
                                    <button type="button" class="decrement">-</button>
                                    <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="1" max="{{ $item->product->Inventory }}" name="quantities[{{ $item->product->id }}]">
                                    <button type="button" class="increment">+</button>
                                </div>
                            @else
                                <div class="quantity-display">
                                    {{ $item->quantity }}x
                                </div>
                                <input type="hidden" name="quantities[{{ $item->product->id }}]" value="{{ $item->quantity }}">
                            @endif

                            <div class="item-price">₱{{ number_format($item->product->Price, 2) }}</div>
<div class="item-subtotal hidden">₱{{ number_format($item->quantity * $item->product->Price, 2) }}</div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">No items in the cart.</p>
                @endif
            </div>
        </div>

        <!-- Total Payment -->
        <div class="section">
            <div class="section-title">Total Payment</div>
            <div class="total-amount">₱<span id="total-amount">{{ number_format($totalAmount, 2) }}</span></div>
        </div>

        <!-- Payment Method (Default Cash) -->
        <div class="section">
            <div class="section-title">Payment Method</div>
            <span class="highlight">
                <i class="fas fa-money-bill-wave" style="color: #28a745; margin-right: 6px;"></i>Cash
            </span>
            <input type="hidden" name="payment_method" value="Cash">
        </div>

        <!-- Submit -->
        <div class="section">
            <button type="submit" class="btn-primary">Place Order</button>
        </div>
    </form>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const orderItems = document.querySelectorAll('.order-item');
        const form = document.getElementById('payment-form');

        // Update total on page load
        updateTotal();

        orderItems.forEach(item => {
            const incrementBtn = item.querySelector('.increment');
            const decrementBtn = item.querySelector('.decrement');
            const quantityInput = item.querySelector('.quantity-input');
            const pricePerItem = parseFloat(item.getAttribute('data-price'));
            const max = parseInt(item.getAttribute('data-max'));

            if (incrementBtn && decrementBtn && quantityInput) {
                // Initialize buttons state
                updateButtonsState(quantityInput, decrementBtn, incrementBtn, max);

                // Button click handlers
                incrementBtn.addEventListener('click', () => {
                    let quantity = parseInt(quantityInput.value);
                    if (quantity < max) {
                        quantityInput.value = quantity + 1;
                        handleQuantityChange(quantityInput, item, pricePerItem, max, decrementBtn, incrementBtn);
                    }
                });

                decrementBtn.addEventListener('click', () => {
                    let quantity = parseInt(quantityInput.value);
                    if (quantity > 1) {
                        quantityInput.value = quantity - 1;
                        handleQuantityChange(quantityInput, item, pricePerItem, max, decrementBtn, incrementBtn);
                    }
                });

                // Input change handler
                quantityInput.addEventListener('change', () => {
                    handleQuantityChange(quantityInput, item, pricePerItem, max, decrementBtn, incrementBtn);
                });

                // Input blur handler to validate value
                quantityInput.addEventListener('blur', () => {
                    let quantity = parseInt(quantityInput.value);
                    if (isNaN(quantity)) {
                        quantity = 1;
                        quantityInput.value = 1;
                    } else if (quantity < 1) {
                        quantityInput.value = 1;
                    } else if (quantity > max) {
                        quantityInput.value = max;
                    }
                    handleQuantityChange(quantityInput, item, pricePerItem, max, decrementBtn, incrementBtn);
                });
            }
        });

        // Form submission handler
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            confirmOrder();
        });

        function confirmOrder() {
            Swal.fire({
                title: "Confirm Your Order",
                text: "Are you sure you want to place this order?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4361ee",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, Place Order",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function handleQuantityChange(input, item, price, max, decrementBtn, incrementBtn) {
            let quantity = parseInt(input.value);
            
            // Validate input
            if (isNaN(quantity)) {
                quantity = 1;
                input.value = 1;
            } else if (quantity < 1) {
                quantity = 1;
                input.value = 1;
            } else if (quantity > max) {
                quantity = max;
                input.value = max;
            }
            
            // Update buttons state
            updateButtonsState(input, decrementBtn, incrementBtn, max);
            
            // Update subtotal
            updateSubtotal(item, quantity, price);
            
            // Update total
            updateTotal();
        }

        function updateButtonsState(input, decrementBtn, incrementBtn, max) {
            const quantity = parseInt(input.value);
            decrementBtn.disabled = quantity <= 1;
            incrementBtn.disabled = quantity >= max;
        }

        function updateSubtotal(item, quantity, pricePerItem) {
            const subtotal = quantity * pricePerItem;
            item.querySelector('.item-subtotal').textContent = `₱${subtotal.toFixed(2)}`;
        }

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.order-item').forEach(item => {
                const quantityInput = item.querySelector('.quantity-input') || item.querySelector('input[type="hidden"]');
                const quantity = parseInt(quantityInput.value);
                const price = parseFloat(item.getAttribute('data-price'));
                total += quantity * price;
            });
            document.getElementById('total-amount').textContent = total.toFixed(2);
        }
    });
</script>
</body>
</html>