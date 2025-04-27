<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard | Carcare</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

  <style>
    :root {
      --primary-color: #6C63FF;
      --secondary-color: #FF6584;
      --accent-color: #00CFE8;
      --bg-color: #f8f9fa;
      --white: #ffffff;
      --dark: #343a40;
    }

    body {
      background-color: white;
      font-family: 'Poppins', sans-serif;
    }

    /* Welcome Section */
    .filter-header {
      padding: 60px 20px 30px 20px;
      text-align: center;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      color: var(--white);
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .welcome-heading {
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 15px;
    }

    .welcome-subheading {
      font-size: 18px;
      color: #e0e0e0;
    }

    /* Search & Buttons */
    .search-wrapper {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
    }

    .search-input {
      padding: 12px 20px;
      width: 600px;
      /* Increased width */
      max-width: 100%;
      border-radius: 30px;
      border: 2px solid #ddd;
      outline: none;
      transition: all 0.3s;
    }

    @media (max-width: 768px) {
      .search-input {
        width: 100%;
        /* Full width on mobile */
      }
    }


    .search-input:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 10px rgba(0, 207, 232, 0.4);
    }

    .button-rounded {
      padding: 12px 24px;
      border-radius: 30px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--white);
      transition: 0.3s;
      text-decoration: none;
    }

    .button-rounded:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-success {
      background: linear-gradient(90deg, #28C76F, #00CFE8);
      border: none;
    }

    .btn-danger {
      background: linear-gradient(90deg, #EA5455, #FF6584);
      border: none;
    }

    /* Card Styles */
    .card {
      background: var(--white);
      border-radius: 15px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      transition: all 0.4s ease;
      height: 97%;
      display: flex;
      flex-direction: column;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .card-link {
      color: inherit;
      text-decoration: none;
      display: block;
      height: 100%;
    }

    .card-image {
      height: 200px;
      background-size: cover;
      background-position: center;
      flex-shrink: 0;
    }

    .card-body {
      padding: 20px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      text-align: center;
    }

    .card-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .card-text {
      font-size: 14px;
      color: #666;
    }

    /* Average Rating */
    .average-rating i {
      color: #FFD700;
    }

    /* No mechanics */
    .no-mechanics {
      text-align: center;
      font-size: 18px;
      color: #999;
      margin-top: 50px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .search-wrapper {
        flex-direction: column;
        align-items: center;
      }

      .search-input {
        width: 100%;
      }

      .button-rounded {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
</head>

<body>

  <!-- Sidebar Component -->
  <x-usersidebar />

  <!-- Main Page Content -->
  <div class="container">

    @if(session('error'))
    <div class="alert alert-danger mt-4">
      {{ session('error') }}
      @if (Route::has('verification.notice'))
      <div class="mt-2">
      <a href="{{ route('verification.notice') }}" class="btn btn-sm btn-primary">Verify Email</a>
      </div>
    @endif
    </div>
  @endif

    <!-- Welcome Header Section -->
    <div class="filter-title">
      <div class="filter-header text-center" style="margin-top: 120px;">
        <h1 class="welcome-heading">
          Welcome{{ Auth::user() ? ', ' . Auth::user()->first_name : '' }}!
        </h1>
        <p class="welcome-subheading">Find the perfect car repair shop for your needs!</p>

        <!-- Search Bar and Action Buttons -->
        <form id="searchForm" onsubmit="return false;">
          <div class="search-wrapper mt-4">
            <!-- Products Button -->
            <a href="{{ route('products.all') }}" class="btn btn-success button-rounded">
              <i class="fas fa-box"></i> Products
            </a>

            <!-- Search Field -->
            <input type="text" name="q" id="searchMechanic" placeholder="Search for a shop..." class="search-input"
              autocomplete="off">

            <!-- Emergency Button -->
            <!--<a href="{{ route('user-emergency-booking') }}" class="btn btn-danger button-rounded">-->
            <!--  <i class="fas fa-ambulance"></i> Emergency-->
            <!--</a>-->
          </div>
        </form>
      </div>
    </div>

    <!-- Shop Cards Section -->
    <div class="content_info" style="margin-top: 30px;">
      <div class="container">
        <div class="row">
          @if(isset($mechanics) && $mechanics->count())
          @foreach($mechanics as $mechanic)
        @if($mechanic->verified)
        @php
      $totalRatings = 0;
      $ratingsCount = 0;
      foreach ($mechanic->services as $service) {
      $totalRatings += $service->ratings->sum('rating');
      $ratingsCount += $service->ratings->count();
      }
      $averageRating = $ratingsCount > 0 ? round($totalRatings / $ratingsCount, 1) : null;
    @endphp

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" data-shopname="{{ $mechanic->shopname }}">
        <a href="{{ route('user.services', $mechanic->id) }}" class="card-link">
        <div class="card">
        <div class="card-image"
          style="background-image: url('{{ $mechanic->image ? asset($mechanic->image) : asset('img/avatar.png') }}');">
        </div>
        <div class="card-body">
          <h5 class="card-title">
          <i class="fas fa-store"></i> {{ $mechanic->shopname }}
          </h5>
          <p class="card-text">
          <i class="fas fa-map-marker-alt"></i> {{ $mechanic->Address }}
          </p>
          <p class="card-text">
          <i class="fas fa-phone"></i> {{ $mechanic->ContactNo }}
          </p>

          <!-- Rating Stars -->
          <div class="average-rating mt-2">
          @if(!is_null($averageRating))
        @for ($i = 1; $i <= 5; $i++)
      @if ($i <= floor($averageRating))
      <i class="fas fa-star"></i>
    @elseif ($i - $averageRating < 1)
      <i class="fas fa-star-half-alt"></i>
    @else
      <i class="far fa-star" style="color: #ccc;"></i>
    @endif
    @endfor
        <p style="font-size: 14px; color: #555;">({{ number_format($averageRating, 1) }}/5)</p>
      @else
      <p style="font-size: 14px; color: #999;">No ratings yet</p>
    @endif
          </div>

        </div>
        </div>
        </a>
        </div>
    @endif
      @endforeach
      @else
      <p class="no-mechanics">No mechanics available.</p>
    @endif
        </div>
      </div>
    </div>

  </div> <!-- End Container -->

  <!-- JS Scripts -->
  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script>

  <!-- Optional custom JS -->
  <script src="{{ asset('assets/js/script1.js') }}"></script>

  <script type="text/javascript">
    function filterShops() {
      const input = document.getElementById("searchMechanic").value.toLowerCase().trim();
const shopCards = document.querySelectorAll(".col-xs-12.col-sm-6.col-md-4.col-lg-4[data-shopname]");

      shopCards.forEach(function (card) {
        const shopName = card.getAttribute("data-shopname").toLowerCase();
        card.style.display = shopName.includes(input) ? "" : "none";
      });
    }

    document.getElementById("searchMechanic").addEventListener("keyup", filterShops);
  </script>

</body>

</html>