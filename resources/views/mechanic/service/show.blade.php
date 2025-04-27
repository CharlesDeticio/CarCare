<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $service->name }} | Carcare</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #4361ee;
      --primary-hover: #3a56d4;
      --accent-color: #f72585;
      --success-color: #4cc9f0;
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

    .service-card {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      background-color: #fff;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      animation: fadeIn 0.5s ease-out;
    }

    .service-gallery {
      padding: 2rem;
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .main-image {
      width: 100%;
      max-height: 400px;
      object-fit: contain;
      border-radius: var(--border-radius);
      margin-bottom: 1rem;
      transition: var(--transition);
      background-color: #f8fafc;
      padding: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .thumbnail-container {
      display: flex;
      gap: 0.8rem;
      justify-content: center;
      flex-wrap: wrap;
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

    .service-details {
      padding: 2rem;
      display: flex;
      flex-direction: column;
    }

    .service-title {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: var(--dark-text);
    }

    .service-price-container {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .service-price {
      font-size: 2rem;
      font-weight: 700;
      color: var(--accent-color);
    }

    .price-label {
      font-size: 1rem;
      color: var(--gray-text);
      font-weight: 400;
    }

    .service-meta {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .meta-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background-color: rgba(67, 97, 238, 0.05);
      padding: 0.8rem;
      border-radius: var(--border-radius);
    }

    .meta-icon {
      color: var(--primary-color);
      font-size: 1.2rem;
    }

    .meta-label {
      font-weight: 500;
      font-size: 0.9rem;
      color: var(--gray-text);
    }

    .meta-value {
      font-weight: 600;
      color: var(--dark-text);
    }

    .service-description {
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
      white-space: pre-line;
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

    /* Service Features */
    .service-features {
      margin: 1.5rem 0;
    }

    .feature-item {
      display: flex;
      align-items: flex-start;
      gap: 0.8rem;
      margin-bottom: 1rem;
    }

    .feature-icon {
      color: var(--primary-color);
      font-size: 1.2rem;
      margin-top: 0.2rem;
    }

    .feature-text {
      color: var(--gray-text);
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .service-card {
        grid-template-columns: 1fr;
      }
      
      .service-gallery {
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
      
      .service-title {
        font-size: 1.5rem;
      }
      
      .service-price {
        font-size: 1.8rem;
      }
      
      .service-meta {
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
    <h1><i class="fas fa-tools"></i> Service Details</h1>
  </header>

  <div class="main-container">
    <div class="service-card">
      <!-- Service Gallery -->
      <div class="service-gallery">
        @if($service->image)
        <img src="{{ asset('upload/'.$service->image) }}" alt="{{ $service->name }}" class="main-image" id="mainImage">
        @else
        <img src="{{ asset('placeholder-image.jpg') }}" alt="No Image Available" class="main-image" id="mainImage">
        @endif
        
        <div class="thumbnail-container">
          <!-- You can add multiple thumbnails here if you have them -->
          @if($service->image)
          <img src="{{ asset('upload/'.$service->image) }}" alt="Thumbnail" class="thumbnail" onclick="changeImage(this)">
          @endif
          <!-- Add more thumbnails as needed -->
        </div>
      </div>
      
      <!-- Service Details -->
      <div class="service-details">
        <h1 class="service-title">{{ $service->name }}</h1>
        
        <div class="service-price-container">
          <span class="price-label">Price:</span>
          <span class="service-price">₱{{ number_format($service->price, 2) }}</span>
        </div>
        
        <!-- Service Features -->
        {{-- <div class="service-features">
          <div class="feature-item">
            <i class="fas fa-check-circle feature-icon"></i>
            <span class="feature-text">Professional service by certified technicians</span>
          </div>
          <div class="feature-item">
            <i class="fas fa-check-circle feature-icon"></i>
            <span class="feature-text">Genuine parts and materials</span>
          </div>
          <div class="feature-item">
            <i class="fas fa-check-circle feature-icon"></i>
            <span class="feature-text">Warranty included</span>
          </div>
        </div> --}}
        
        <!-- Service Description -->
        <div class="service-description">
          <h3 class="description-title">Service Details</h3>
          <div class="description-content">
            {{ $service->description ? $service->description : 'No detailed description available for this service.' }}
          </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
          <a href="{{ route('mechanic.edit', $service->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Service
          </a>
          <a href="{{ route('mechanic.dashboard') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Services
          </a>
        </div>
      </div>
    </div>
    
    {{-- <a href="{{ route('mechanic.dashboard') }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Return to Service Dashboard
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