<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $product->ProductName }} - Carcare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Str::limit($product->Description, 150) }}">

    <!-- Fonts & Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --accent-color: #253af7;
            --success-color: #4cc9f0;
            --warning-color: #ffbc00;
            --light-bg: #f8f9fa;
            --dark-text: #2b2d42;
            --gray-text: #6c757d;
            --border-radius: 12px;
            --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
        }

        .navigation-container {
            max-width: 1200px;
            margin: 30px auto 0;
            padding: 0 40px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .back-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            background-color: #fff;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin: 20px auto 50px;
            max-width: 1200px;
        }

        .product-gallery {
            flex: 1 1 40%;
            position: relative;
        }

        .product-main-image {
            width: 100%;
            max-width: 500px;
            border-radius: var(--border-radius);
            object-fit: contain;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            background-color: #f8fafc;
            padding: 1rem;
        }

        .product-main-image:hover {
            transform: scale(1.03);
        }

        .thumbnail-container {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: var(--transition);
        }

        .thumbnail:hover {
            border-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .product-details {
            flex: 1 1 55%;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark-text);
        }

        .product-category {
            display: inline-block;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .in-stock {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .low-stock {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .out-of-stock {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .product-attributes {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .attribute-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: rgba(248, 249, 250, 0.8);
            padding: 0.8rem;
            border-radius: var(--border-radius);
            margin-top: 10px;
        }

        .attribute-icon {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .attribute-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: var(--gray-text);
        }

        .attribute-value {
            font-weight: 600;
            color: var(--dark-text);
        }

        .product-description {
            margin-bottom: 30px;
        }

        .description-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-text);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .description-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }

        .description-content {
            color: var(--gray-text);
            line-height: 1.7;
            white-space: pre-line;
        }

        .product-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0.8rem 1.5rem;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .btn-cart {
            background-color: var(--warning-color);
            color: var(--dark-text);
            box-shadow: 0 4px 12px rgba(255, 188, 0, 0.2);
        }

        .btn-cart:hover {
            background-color: #e6a600;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 188, 0, 0.3);
        }

        .btn-buy {
            background-color: var(--accent-color);
            color: #fff;
            /* box-shadow: 0 4px 12px rgba(247, 37, 133, 0.2); */
        }

        .btn-buy:hover {
            background-color: #79d0db;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(247, 37, 133, 0.3);
        }

        .btn-chat {
            background-color: var(--success-color);
            color: #fff;
            box-shadow: 0 4px 12px rgba(76, 201, 240, 0.2);
        }

        .btn-chat:hover {
            background-color: #3ab5d9;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(76, 201, 240, 0.3);
        }

        .rating-section {
            background-color: #fff;
            padding: 30px;
            margin: 40px auto;
            max-width: 1200px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--dark-text);
            position: relative;
            padding-bottom: 0.8rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .average-rating {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 2rem;
        }

        .rating-stars {
            font-size: 1.8rem;
            letter-spacing: 2px;
        }

        .rating-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .rating-count {
            color: var(--gray-text);
        }

        .review-card {
            border-bottom: 1px solid #eee;
            padding: 1.5rem 0;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .review-user {
            font-weight: 600;
            color: var(--dark-text);
        }

        .review-date {
            color: var(--gray-text);
            font-size: 0.9rem;
        }

        .review-stars {
            margin: 0.5rem 0;
            color: #ffc107;
        }

        .review-comment {
            color: var(--gray-text);
            line-height: 1.7;
        }

        .no-reviews {
            color: var(--gray-text);
            text-align: center;
            padding: 2rem 0;
        }

        button:disabled {
            background-color: #cccccc !important;
            color: #666666 !important;
            cursor: not-allowed !important;
            box-shadow: none !important;
            transform: none !important;
            opacity: 0.7;
        }

        @media (max-width: 992px) {
            .product-container {
                flex-direction: column;
                padding: 30px;
                gap: 30px;
            }

            .product-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .navigation-container {
                padding: 0 20px;
            }

            .product-container {
                padding: 20px;
                margin: 15px auto 30px;
            }

            .product-title {
                font-size: 1.6rem;
            }

            .product-price {
                font-size: 1.8rem;
            }

            .product-attributes {
                grid-template-columns: 1fr;
            }

            .rating-section {
                padding: 20px;
                margin: 30px auto;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>

<body>

    <!-- Back Button -->
    <div class="navigation-container fade-in">
        <a href="{{ route('products.all') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Products
        </a>
    </div>

    <!-- Product Container -->
    <div class="product-container fade-in">
        <!-- Product Gallery -->
        <div class="product-gallery">
            @if($product->image)
                <img src="{{ asset('upload/' . $product->image) }}" alt="{{ $product->ProductName }}" 
                     class="product-main-image" id="mainImage">
            @else
                <img src="{{ asset('assets/img/placeholder-image.jpg') }}" alt="No Image Available" 
                     class="product-main-image" id="mainImage">
            @endif

            <div class="thumbnail-container">
                <!-- You can add multiple thumbnails if available -->
                @if($product->image)
                    <img src="{{ asset('upload/' . $product->image) }}" alt="Thumbnail" 
                         class="thumbnail" onclick="changeImage(this)">
                @endif
                <!-- Add more thumbnails as needed -->
            </div>
        </div>

        <!-- Product Details -->
        <div class="product-details">
            <h1 class="product-title">{{ $product->ProductName }}</h1>
            
            @if($product->category)
                <span class="product-category">{{ $product->category }}</span>
            @endif

            <div class="product-price">₱{{ number_format($product->Price, 2) }}</div>

            @if($product->Inventory > 10)
                <div class="stock-status in-stock">
                    <i class="fas fa-check-circle"></i> In Stock ({{ $product->Inventory }} available)
                </div>
            @elseif($product->Inventory > 0)
                <div class="stock-status low-stock">
                    <i class="fas fa-exclamation-circle"></i> Low Stock (Only {{ $product->Inventory }} left)
                </div>
            @else
                <div class="stock-status out-of-stock">
                    <i class="fas fa-times-circle"></i> Out of Stock
                </div>
            @endif

            <div class="product-attributes">
                @if($product->color)
                    <div class="attribute-item">
                        <i class="fas fa-palette attribute-icon"></i>
                        <div>
                            <div class="attribute-label">Color</div>
                            <div class="attribute-value">{{ $product->color }}</div>
                        </div>
                    </div>
                @endif

                @if($product->width)
                    <div class="attribute-item">
                        <i class="fas fa-ruler-horizontal attribute-icon"></i>
                        <div>
                            <div class="attribute-label">Width</div>
                            <div class="attribute-value">{{ $product->width }} cm</div>
                        </div>
                    </div>
                @endif

                @if($product->height)
                    <div class="attribute-item">
                        <i class="fas fa-ruler-vertical attribute-icon"></i>
                        <div>
                            <div class="attribute-label">Height</div>
                            <div class="attribute-value">{{ $product->height }} cm</div>
                        </div>
                    </div>
                @endif

                @if($product->weight)
                    <div class="attribute-item">
                        <i class="fas fa-weight-hanging attribute-icon"></i>
                        <div>
                            <div class="attribute-label">Weight</div>
                            <div class="attribute-value">{{ $product->weight }} kg</div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="product-description">
                <h3 class="description-title">Product Description</h3>
                <div class="description-content">
                    {{ $product->Description ?: 'No detailed description available for this product.' }}
                </div>
            </div>

            <div class="product-actions">
                <!-- Chat with Mechanic Button -->
                {{-- @if(isset($mechanic))
                <a href="{{ route('user.messages.chat', $mechanic->id) }}" class="btn btn-chat">
                    <i class="fas fa-comments"></i> Chat with Shop
                </a>
                @endif --}}

                <!-- Add to Cart Button -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                    @csrf
                    <button type="submit" class="btn btn-cart" @if($product->Inventory <= 0) disabled @endif>
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>

                <!-- Buy Now Button -->
                <form action="{{ route('payments.buyNow', $product->id) }}" method="GET" class="buy-now-form">
                    <button type="submit" class="btn btn-buy" @if($product->Inventory <= 0) disabled @endif>
                        <i class="fas fa-credit-card"></i> Buy Now
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Rating Section -->
    <div class="rating-section fade-in">
        <h3 class="section-title">Customer Reviews</h3>
        
        @if(!is_null($averageRating))
            <div class="average-rating">
                <div class="rating-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($averageRating))
                            <i class="fas fa-star"></i>
                        @elseif ($i - $averageRating < 1)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <div>
                    <span class="rating-value">{{ number_format($averageRating, 1) }}</span>
                    <span class="rating-count">({{ $product->ratings->count() }} reviews)</span>
                </div>
            </div>
        @else
            <p class="no-reviews">No ratings yet for this product</p>
        @endif

        @forelse($product->ratings as $rating)
            <div class="review-card">
                <div class="review-header">
                    <span class="review-user">{{ $rating->user->first_name }}</span>
                    <span class="review-date">{{ $rating->created_at->format('M d, Y') }}</span>
                </div>
                <div class="review-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $rating->rating)
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <p class="review-comment">{{ $rating->comment ?? 'No comment provided.' }}</p>
            </div>
        @empty
            <p class="no-reviews">No reviews yet for this product</p>
        @endforelse
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Change main image when thumbnail is clicked
            function changeImage(element) {
                document.getElementById('mainImage').src = element.src;
            }

            // Add to cart confirmation
            const addToCartForm = document.querySelector('.add-to-cart-form');
            if (addToCartForm) {
                addToCartForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: 'Add to Cart?',
                        text: 'Do you want to add this product to your shopping cart?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#ffbc00',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, Add to Cart',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            addToCartForm.submit();
                        }
                    });
                });
            }

            // Show success/error messages
            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonColor: '#4361ee',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonColor: '#f72585',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
        });
    </script>
</body>
</html>