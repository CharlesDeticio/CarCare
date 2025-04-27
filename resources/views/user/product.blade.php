<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

    <meta name="notification-route" content="{{ route('user.getNotifications') }}">

    <style>
        :root {
            --primary-color: #6C63FF;
            --secondary-color: #FF6584;
            --accent-color: #00CFE8;
            --background-color: #f5f7fa;
            --dark-color: #343a40;
            --text-color: #333;
            --white-color: #fff;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        #layout {
            padding: 30px 15px;
        }

        .container {
            max-width: 1200px;
        }

        /* Search Section */
        .search-section {
            margin: 50px 0;
            text-align: center;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            padding: 40px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            color: var(--white-color);
        }

        .search-title {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        #productSearch {
            width: 50%;
            min-width: 250px;
            padding: 14px 20px;
            font-size: 16px;
            border: none;
            border-radius: 30px;
            outline: none;
            transition: box-shadow 0.3s ease;
        }

        #productSearch:focus {
            box-shadow: 0 0 10px rgba(0, 207, 232, 0.4);
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-color));
            color: var(--white-color);
            font-weight: bold;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .product-card {
            background: var(--white-color);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.4s, box-shadow 0.4s;
            position: relative;
        }
        .details {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.details h5 {
    min-height: 48px; /* Control height of the title */
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
}

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .details {
            padding: 20px;
        }

        .details h5 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .details p {
            font-size: 1rem;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .rating-stars i {
            color: #FFD700;
            margin-right: 2px;
        }

        .btn-add {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            font-size: 14px;
            font-weight: bold;
            background: linear-gradient(90deg, #FF5722, #E64A19);
            color: var(--white-color);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn-add:hover {
            background: linear-gradient(90deg, #E64A19, #FF5722);
            transform: translateY(-2px);
        }

        .product-link {
            text-decoration: none;
            color: inherit;
        }

        /* Responsive */
        @media (max-width: 576px) {
            #productSearch {
                width: 100%;
            }

            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-action {
                width: 100%;
            }
        }

        .out-stock-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background-color: rgba(220, 53, 69, 0.9); /* Bootstrap danger color with transparency */
    color: #fff;
    padding: 8px 12px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 8px;
    z-index: 10;
}

.product-card.out-of-stock {
    position: relative;
    opacity: 0.6; /* Dimmed look */
}

.product-card.out-of-stock img {
    filter: grayscale(100%);
}

.product-card.out-of-stock:hover {
    transform: none; /* disable hover effect */
    box-shadow: none;
    cursor: not-allowed;
}

#chat-button {
            position: fixed;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.3s ease;
            z-index: 9999;
            bottom: 30px;
            right: 30px;
        }

        #chat-button:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        #chat-button i {
            color: var(--white);
            font-size: 24px;
        }

    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-usersidebar />

    <!-- Main Layout -->
    <div id="layout">
        <div class="container">

            <!-- Search Section -->
            <div class="search-section">
                <h2 class="search-title">Find the Best Products for Your Car</h2>
                <div class="search-container">
                    <input type="text" id="productSearch" placeholder="Search for products...">

                    <a href="{{ route('user.services', ['id' => $mechanic->id]) }}" class="btn-action">
                        <i class="fas fa-tools"></i> Book Service
                    </a>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="product-grid">
                @foreach($products as $product)
    @php
        $outOfStock = $product->Inventory <= 0;
    @endphp

    <!-- Wrap in link only if it's in stock -->
    @if(!$outOfStock)
        <a href="{{ route('product-view', ['id' => $product->id]) }}" class="product-link">
    @endif

    <div class="product-card {{ $outOfStock ? 'out-of-stock' : '' }}" data-name="{{ strtolower($product->ProductName) }}" style="{{ $outOfStock ? 'pointer-events: none; opacity: 0.6;' : '' }}">
        
        <!-- Product Image -->
        <img src="{{ $product->image ? asset('upload/' . $product->image) : asset('assets/img/default-product.jpg') }}" alt="{{ $product->ProductName }}">

        <!-- Out of Stock Badge -->
        @if($outOfStock)
            <div class="out-stock-badge">Out of Stock</div>
        @endif

        <div class="details">
            <h5>{{ $product->ProductName }}</h5>

            <!-- Rating -->
            <div class="rating-stars mb-2">
                @if ($product->ratings_count > 0)
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($product->average_rating))
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star" style="color: #ccc;"></i>
                        @endif
                    @endfor
                    <small>({{ $product->ratings_count }} reviews)</small>
                @else
                    <small class="text-muted">No ratings yet</small>
                @endif
            </div>

            <!-- Price -->
            <p>₱{{ number_format($product->Price, 2) }}</p>
        </div>
    </div>

    @if(!$outOfStock)
        </a>
    @endif
@endforeach

            </div>

        </div>
    </div>

    <!--<a href="{{ route('user.messages.chat', $mechanic->id) }}" id="chat-button" title="Chat with Mechanic">-->
    <!--    <i class="fa fa-comments"></i>-->
    <!--</a>-->

    <!-- JS Scripts -->
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

    <!-- Custom Script -->
    <script src="{{ asset('assets/js/script1.js') }}"></script>

    <script>
        // SweetAlert confirmation (optional for Add to Cart)
        document.addEventListener('DOMContentLoaded', function () {
            const addToCartForms = document.querySelectorAll('.add-to-cart-form');

            addToCartForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Added to Cart!',
                        text: 'The product has been added to your cart.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 2000,
                        timerProgressBar: true,
                    }).then(() => {
                        form.submit();
                    });
                });
            });
        });

        // Search Filter
        document.getElementById('productSearch').addEventListener('input', function () {
            let searchQuery = this.value.toLowerCase().trim();
            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                let productName = card.getAttribute('data-name');
                card.parentElement.style.display = productName.includes(searchQuery) ? '' : 'none';
            });
        });

        // Toastr Notifications (optional)
        toastr.options = {
            "positionClass": "toast-top-center",
            "timeOut": "500",
            "closeButton": true,
        };

        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

</body>

</html>
