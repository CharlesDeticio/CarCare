<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Products - Carcare</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  {{--
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css"> --}}

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">
  
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
      --border-radius: 10px;
      --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s ease;
    }
    
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
      margin-top: 40px;
      color: var(--dark);
    }
    
    .page-title {
      color: var(--primary);
      margin-bottom: 40px;
      font-weight: 700;
      text-align: center;
      position: relative;
      padding-bottom: 15px;
    }
    
    .page-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }
    
    .filter-section {
      background-color: #fff;
      padding: 25px;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      margin-bottom: 40px;
    }
    
    .search-box {
      position: relative;
    }
    
    .search-box .form-control {
      padding-left: 45px;
      border-radius: var(--border-radius);
      border: 1px solid var(--light-gray);
      height: 48px;
      box-shadow: none;
    }
    
    .search-box .search-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
    }
    
    .search-box .btn-search {
      position: absolute;
      right: 5px;
      top: 50%;
      transform: translateY(-50%);
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 0 var(--border-radius) var(--border-radius) 0;
      height: 38px;
      width: 38px;
      transition: var(--transition);
    }
    
    .search-box .btn-search:hover {
      background: var(--primary-dark);
    }
    
    .filter-select {
      height: 48px;
      border-radius: var(--border-radius);
      border: 1px solid var(--light-gray);
      box-shadow: none;
    }
    
    .btn-action {
      height: 48px;
      border-radius: var(--border-radius);
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: var(--transition);
    }
    
    .btn-filter {
      background-color: var(--info);
      color: white;
    }
    
    .btn-filter:hover {
      background-color: #138496;
      transform: translateY(-2px);
    }
    
    .btn-reset {
      background-color: var(--gray);
      color: white;
    }
    
    .btn-reset:hover {
      background-color: #5a6268;
      transform: translateY(-2px);
    }
    
    .product-card {
      background-color: #fff;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      transition: var(--transition);
      height: 100%;
      display: flex;
      flex-direction: column;
      position: relative;
      border: 1px solid rgba(0, 0, 0, 0.05);
        width: 100%; /* Ensure card takes full width of its container */
    }
    
    /* Add this to your existing styles */
.row.g-4 {
  display: flex;
  flex-wrap: wrap;
}

.row.g-4 > [class*='col-'] {
  display: flex;
}

/* Optional: Set a fixed height if you want cards to be same height */
.product-card .product-body {
  flex: 1; /* This makes the body take up remaining space */
}
    
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .product-link {
      text-decoration: none;
      color: inherit;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    
    .product-link:hover {
      text-decoration: none;
      color: inherit;
    }
    
    .product-image-container {
      position: relative;
      width: 100%;
      padding-top: 75%; /* 4:3 aspect ratio */
      overflow: hidden;
    }
    
    .product-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      background-color: #f1f1f1;
      transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image {
      transform: scale(1.05);
    }
    
    .product-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: var(--primary);
      color: white;
      font-size: 12px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 50px;
      z-index: 1;
    }
    
    .out-stock-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: var(--danger);
      color: white;
      font-size: 12px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 50px;
      z-index: 1;
    }
    
    .product-body {
      padding: 20px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }
    
    .product-category {
      background-color: var(--primary);
      color: white;
      font-size: 12px;
      font-weight: 500;
      padding: 4px 12px;
      border-radius: 50px;
      display: inline-block;
      margin-bottom: 10px;
      align-self: flex-start;
    }
    
    .product-name {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--dark);
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .product-price {
      color: var(--success);
      font-weight: 700;
      font-size: 18px;
      margin-bottom: 10px;
    }
    
    .rating-container {
      display: flex;
      align-items: center;
      margin-bottom: 12px;
    }
    
    .rating-stars {
      color: #FFD700;
      margin-right: 8px;
    }
    
    .rating-text {
      font-size: 14px;
      color: var(--gray);
    }
    
    .shop-info {
      margin-top: auto;
      padding-top: 12px;
      border-top: 1px solid var(--light-gray);
    }
    
    .shop-name {
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 2px;
    }
    
    .shop-address {
      font-size: 13px;
      color: var(--gray);
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .no-products {
      text-align: center;
      padding: 60px 20px;
      background-color: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
    }
    
    .no-products-icon {
      font-size: 60px;
      color: var(--gray);
      margin-bottom: 20px;
    }
    
    .no-products-text {
      font-size: 18px;
      color: var(--gray);
      margin-bottom: 20px;
    }
    
    .product-card.out-of-stock {
      position: relative;
    }
    
    .product-card.out-of-stock::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.7);
      z-index: 1;
    }
    
    .pagination {
      justify-content: center;
      margin-top: 40px;
    }
    
    .page-item.active .page-link {
      background-color: var(--primary);
      border-color: var(--primary);
    }
    
    .page-link {
      color: var(--primary);
    }
    
    @media (max-width: 768px) {
      .filter-section {
        padding: 15px;
      }
      
      .btn-action {
        width: 100%;
      }
      
      .product-name {
        font-size: 16px;
      }
      
      .product-price {
        font-size: 16px;
      }
    }
  </style>
</head>

<body>
  <x-usersidebar />

  <div class="container py-5">
    <h1 class="page-title">Explore Our Products</h1>

    <!-- Search and Filter Section -->
    <form action="{{ route('products.all') }}" method="GET" class="filter-section">
      <div class="row g-3">
        <!-- Search Input -->
        <div class="col-md-5">
          <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
            <button class="btn-search" type="submit">
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>
        </div>
        
        <!-- Category Filter -->
        <div class="col-md-3">
          <select name="category" class="form-select filter-select">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
              <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
          </select>
        </div>
        
        <!-- Filter Button -->
        <div class="col-md-2">
          <button type="submit" class="btn btn-action btn-filter w-100">
            <i class="fas fa-filter"></i> Filter
          </button>
        </div>
        
        <!-- Reset Button -->
        <div class="col-md-2">
          <a href="{{ route('products.all') }}" class="btn btn-action btn-reset w-100">
            <i class="fas fa-sync-alt"></i> Reset
          </a>
        </div>
      </div>
    </form>

    <!-- Products Grid -->
    @if($products->isEmpty())
      <div class="no-products">
        <div class="no-products-icon">
          <i class="fas fa-box-open"></i>
        </div>
        <h3 class="no-products-text">No products found</h3>
        <a href="{{ route('products.all') }}" class="btn btn-primary">
          <i class="fas fa-sync-alt"></i> Reset Filters
        </a>
      </div>
    @else
      <div class="row g-4">
        @foreach($products as $product)
          @php
            $outOfStock = $product->Inventory <= 0;
            $averageRating = $product->ratings()->avg('rating');
          @endphp

          <div class="col-sm-6 col-md-4 col-lg-3 d-flex">
            <div class="product-card {{ $outOfStock ? 'out-of-stock' : '' }}">
              @if(!$outOfStock)
                <a href="{{ route('product-view', ['id' => $product->id]) }}" class="product-link">
              @endif
              
                <!-- Product Image -->
                <div class="product-image-container">
                  <img src="{{ $product->image ? asset('upload/' . $product->image) : asset('images/no-image.png') }}"
                       alt="{{ $product->ProductName }}" class="product-image">
                  
                  @if($outOfStock)
                    <div class="out-stock-badge">Out of Stock</div>
                  @endif
                  
                  <div class="product-badge">{{ $product->category }}</div>
                </div>
                
                <!-- Product Body -->
                <div class="product-body">
                  <h3 class="product-name">{{ $product->ProductName }}</h3>
                  <div class="product-price">₱{{ number_format($product->Price, 2) }}</div>
                  
                  <!-- Rating -->
                  @if(!is_null($averageRating))
                    <div class="rating-container">
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
                      <span class="rating-text">({{ number_format($averageRating, 1) }})</span>
                    </div>
                  @else
                    <div class="rating-container">
                      <span class="rating-text">No ratings yet</span>
                    </div>
                  @endif
                  
                  <!-- Shop Info -->
                  <div class="shop-info">
                    <div class="shop-name">{{ $product->mechanic->shopname ?? 'N/A' }}</div>
                    <div class="shop-address">{{ $product->mechanic->Address ?? 'N/A' }}</div>
                  </div>
                </div>
              
              @if(!$outOfStock)
                </a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
      
      <!-- Pagination -->
      {{-- @if($products->hasPages())
        <nav aria-label="Page navigation">
          {{ $products->links() }}
        </nav>
      @endif --}}
    @endif
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
    // Add smooth scrolling to all links
    $(document).ready(function(){
      $("a").on('click', function(event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
            window.location.hash = hash;
          });
        }
      });
    });
  </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script>
<script src="{{ asset('assets/js/script1.js') }}"></script>
</body>

</html>