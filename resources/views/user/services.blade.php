<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">
    <meta name="notification-route" content="{{ route('user.getNotifications') }}">

    <style>
    :root {
        --primary-color: #6C63FF;
        --secondary-color: #FF6584;
        --accent-color: #00CFE8;
        --light-bg: #f9f9f9;
        --dark-bg: #343a40;
        --text-color: #333;
        --white: #fff;
    }

    body {
        background-color: var(--light-bg);
        color: var(--text-color);
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Welcome Section */
    .welcome-section {
        padding: 60px 20px 30px 20px;
        text-align: center;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: var(--white);
    }

    .welcome-section h1 {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .welcome-section p {
        font-size: 18px;
        color: #e0e0e0;
    }

    /* Search Section */
    .search-section {
        padding: 30px 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .search-wrapper {
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-wrapper input[type="text"] {
        flex: 1;
        min-width: 250px;
        padding: 14px 20px;
        font-size: 16px;
        border: 2px solid var(--primary-color);
        border-radius: 30px;
        outline: none;
        transition: 0.3s;
    }

    .search-wrapper input[type="text"]:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 10px rgba(0, 207, 232, 0.2);
    }

    .search-wrapper button,
    .search-wrapper a.shop-btn {
        padding: 12px 20px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: var(--white);
        font-size: 16px;
        border-radius: 30px;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s ease;
    }

    .search-wrapper button:hover,
    .search-wrapper a.shop-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(108, 99, 255, 0.2);
    }

    .search-wrapper i {
        margin-right: 8px;
    }

    /* Services Section */
    .services-section {
        padding: 50px 20px;
    }

    .services-container {
        display: flex;
        flex-wrap: wrap;
justify-content: flex-start;
        align-items: stretch;
        gap: 20px;
    }

    .service-item {
        flex: 1 1 100%;
        max-width: 100%;
        display: flex;
    }

    @media (min-width: 576px) {
        .service-item {
            flex: 1 1 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }

    @media (min-width: 768px) {
        .service-item {
            flex: 1 1 calc(33.33% - 20px);
            max-width: calc(33.33% - 20px);
        }
    }

    @media (min-width: 1200px) {
        .service-item {
            flex: 1 1 calc(25% - 20px);
            max-width: calc(25% - 20px);
        }
    }

    .service-item:hover {
        transform: translateY(-10px);
    }

    .service-item a {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-grow: 1;
    }

    .service-item .card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
        background-color: var(--white);
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
    }

    .service-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .service-item .card-body {
        flex: 1;
        text-align: center;
        padding: 25px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .service-item .card-title {
        font-size: 1.25rem;
        color: var(--dark-bg);
        font-weight: 600;
        margin-bottom: 12px;
    }

    .service-item .card-text {
        font-size: 1.1rem;
        color: var(--primary-color);
        font-weight: 700;
    }

    .average-rating i {
        color: #FFD700;
    }

    /* Floating Chat Button */
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

    <!-- Sidebar Component -->
    <x-usersidebar />

    <!-- Main Content -->
    <section class="home-section" style="margin-top: 70px;">

        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Welcome to {{ $mechanic->shopname }}!</h1>
            <p>Your trusted online service provider for all your car needs.</p>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <div class="search-wrapper">
                <input type="text" id="searchInput" placeholder="Search for services..." onkeyup="filterServices()">

                <a href="{{ route('user.product', $mechanic->id) }}" class="shop-btn">
                    <i class="fa fa-shopping-cart"></i> Products
                </a>
            </div>
        </div>

        <!-- Services Section -->
        <section class="services-section">
            @if($mechanic->services->isEmpty())
                <p class="text-center text-muted">No services found.</p>
            @else
                <div class="services-container" id="servicesContainer">
                    @foreach($mechanic->services as $service)
                        <div class="service-item">
                            <a href="{{ route('user.service-details', $service->id) }}">
                                <div class="card">
                                    <img src="{{ $service->image ? asset('upload/' . $service->image) : asset('img/default_service.jpg') }}"
                                         alt="{{ $service->name }}">

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $service->name }}</h5>

                                        <p class="card-text">₱{{ number_format($service->price, 2) }}</p>

                                        @php
                                            $avgRating = round($service->ratings->avg('rating') ?? 0);
                                        @endphp

                                        <div class="average-rating mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $avgRating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star" style="color: #ccc;"></i>
                                                @endif
                                            @endfor
                                            <span style="font-size: 14px;">({{ number_format($service->ratings->avg('rating') ?? 0, 1) }}/5)</span>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

    </section>

    <!-- Floating Chat Button -->
    <!-- <a href="{{ route('user.messages.chat', $mechanic->id) }}" id="chat-button" title="Chat with Mechanic">-->
    <!--    <i class="fa fa-comments"></i>-->
    <!--</a> -->

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/js/script1.js') }}"></script>

    <script>
        function filterServices() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let serviceItems = document.querySelectorAll('.service-item');

            let found = false;

            serviceItems.forEach(function (item) {
                let title = item.querySelector('.card-title').textContent.toLowerCase();

                if (title.includes(input)) {
                    item.style.display = "flex";
                    found = true;
                } else {
                    item.style.display = "none";
                }
            });

            const container = document.getElementById('servicesContainer');
            let noResults = document.getElementById('noResultsMessage');

            if (!found) {
                if (!noResults) {
                    noResults = document.createElement('p');
                    noResults.id = 'noResultsMessage';
                    noResults.className = 'text-center text-muted mt-3';
                    noResults.innerText = 'No services match your search.';
                    container.appendChild(noResults);
                }
            } else {
                if (noResults) {
                    noResults.remove();
                }
            }
        }
    </script>

</body>

</html>
