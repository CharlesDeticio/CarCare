<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $product->ProductName }} | Carcare</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary-color: #4361ee;
      --primary-hover: #3a56d4;
      --accent-color: #f72585;
      --light-bg: #f8f9fa;
      --dark-text: #2b2d42;
      --gray-text: #6c757d;
      --border-radius: 12px;
      --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light-bg);
      color: var(--dark-text);
      line-height: 1.6;
    }

    header {
      background: linear-gradient(135deg, var(--primary-color), #5a72ef);
      color: white;
      padding: 1.5rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
      position: relative;
      overflow: hidden;
    }

    header h1 {
      font-size: 1.8rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.8rem;
    }

    header::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    }

    .main-container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
    }

    .product-card {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      background-color: #fff;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      animation: fadeIn 0.5s ease-out;
    }

    .product-gallery {
      padding: 2rem;
      position: relative;
    }

    .main-image {
      width: 100%;
      height: 400px;
      object-fit: contain;
      border-radius: var(--border-radius);
      margin-bottom: 1rem;
      transition: var(--transition);
      background-color: #f8fafc;
      padding: 1rem;
    }

    .thumbnail-container {
      display: flex;
      gap: 0.8rem;
      justify-content: center;
    }

    .thumbnail {
      width: 60px;
      height: 60px;
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
      padding: 2rem;
      display: flex;
      flex-direction: column;
    }

    .product-title {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
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
      margin-bottom: 1.5rem;
    }

    .product-price {
      font-size: 2rem;
      font-weight: 700;
      color: var(--accent-color);
      margin-bottom: 1.5rem;
    }

    .price-label {
      font-size: 1rem;
      color: var(--gray-text);
      font-weight: 400;
    }

    .product-meta {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .meta-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .meta-icon {
      color: var(--primary-color);
      font-size: 1.2rem;
    }

    .meta-label {
      font-weight: 500;
      font-size: 0.9rem;
    }

    .meta-value {
      font-weight: 600;
      color: var(--dark-text);
    }

    .product-description {
      margin-bottom: 2rem;
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
    }

    .action-buttons {
      display: flex;
      gap: 1rem;
      margin-top: auto;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.8rem 1.5rem;
      border-radius: var(--border-radius);
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      text-decoration: none;
    }

    .btn-primary {
      background-color: var(--primary-color);
      color: white;
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
      border: none;
    }

    .btn-primary:hover {
      background-color: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
    }

    .btn-outline {
      background-color: transparent;
      border: 2px solid var(--primary-color);
      color: var(--primary-color);
    }

    .btn-outline:hover {
      background-color: rgba(67, 97, 238, 0.05);
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      margin-top: 2rem;
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
    }

    .back-link:hover {
      color: var(--primary-hover);
      transform: translateX(-3px);
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .product-card {
        grid-template-columns: 1fr;
      }
      
      .product-gallery {
        padding-bottom: 0;
      }
      
      .main-image {
        height: 300px;
      }
    }

    @media (max-width: 768px) {
      header h1 {
        font-size: 1.5rem;
      }
      
      .product-title {
        font-size: 1.5rem;
      }
      
      .product-price {
        font-size: 1.8rem;
      }
      
      .product-meta {
        grid-template-columns: 1fr;
      }
      
      .action-buttons {
        flex-direction: column;
      }
      
      .btn {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <header>
    <h1><i class="fas fa-cube"></i> Product Details</h1>
  </header>

  <div class="main-container">
    <div class="product-card">
      <!-- Product Gallery -->
      <div class="product-gallery">
        @if($product->image)
        <img src="{{ asset('upload/'.$product->image) }}" alt="{{ $product->ProductName }}" class="main-image" id="mainImage">
        @else
        <img src="{{ asset('placeholder-image.jpg') }}" alt="No Image Available" class="main-image" id="mainImage">
        @endif
        
        <div class="thumbnail-container">
          <!-- You can add multiple thumbnails here if you have them -->
          @if($product->image)
          <img src="{{ asset('upload/'.$product->image) }}" alt="Thumbnail" class="thumbnail" onclick="changeImage(this)">
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
        
        <div class="product-price">
          <span class="price-label">Price:</span> ₱{{ number_format($product->Price, 2) }}
        </div>
        
        <!-- Product Meta Information -->
        <div class="product-meta">
          @if($product->Inventory !== null)
          <div class="meta-item">
            <i class="fas fa-boxes meta-icon"></i>
            <div>
              <div class="meta-label">Inventory</div>
              <div class="meta-value">{{ $product->Inventory }} in stock</div>
            </div>
          </div>
          @endif
          
          @if($product->color)
          <div class="meta-item">
            <i class="fas fa-palette meta-icon"></i>
            <div>
              <div class="meta-label">Color</div>
              <div class="meta-value">{{ $product->color }}</div>
            </div>
          </div>
          @endif
          
          @if($product->weight)
          <div class="meta-item">
            <i class="fas fa-weight-hanging meta-icon"></i>
            <div>
              <div class="meta-label">Weight</div>
              <div class="meta-value">{{ $product->weight }} kg</div>
            </div>
          </div>
          @endif
          
          @if($product->width && $product->height)
          <div class="meta-item">
            <i class="fas fa-ruler-combined meta-icon"></i>
            <div>
              <div class="meta-label">Dimensions</div>
              <div class="meta-value">{{ $product->width }}cm × {{ $product->height }}cm</div>
            </div>
          </div>
          @endif
        </div>
        
        <!-- Product Description -->
        <div class="product-description">
          <h3 class="description-title">Product Details</h3>
          <div class="description-content">
            {{ $product->Description ? $product->Description : 'No description available for this product.' }}
          </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
          <a href="{{ route('mechanic.product.edit', $product->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Product
          </a>
          <a href="{{ route('mechanic.productdashboard') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Products
          </a>
        </div>
      </div>
    </div>
    
    {{-- <a href="{{ route('mechanic.productdashboard') }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Return to Product Dashboard
    </a> --}}
  </div>

  <script>
    // Change main image when thumbnail is clicked
    function changeImage(element) {
      document.getElementById('mainImage').src = element.src;
    }
    
    // Add animation to main image on hover
    const mainImage = document.getElementById('mainImage');
    if (mainImage) {
      mainImage.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.03)';
      });
      
      mainImage.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
      });
    }
  </script>
</body>

</html>