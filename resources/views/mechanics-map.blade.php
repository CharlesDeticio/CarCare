<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <title>Mechanics Map</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

    <style>
        #map {
            height: 100vh;
            width: 100%;
        }

        .custom-popup {
            text-align: center;
            max-width: 200px;
        }

        .custom-popup img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .custom-popup h5 {
            margin: 0;
            font-size: 16px;
        }

        .custom-popup p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .custom-popup a {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <x-usersidebar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Mechanics Location</h1>
        <div id="map"></div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const MAPTILER_API_KEY = "gPDa74mAZTitZuCiw7vl"; // Replace with your actual key

            // Initialize map
            const map = L.map('map').setView([10.312537, 123.960223], 12);

            // Add MapTiler tiles
            L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${MAPTILER_API_KEY}`, {
                attribution: '&copy; <a href="https://www.maptiler.com/">MapTiler</a> contributors'
            }).addTo(map);

            // Dynamic markers from Laravel
            @foreach($mechanics as $mechanic)
                    @if($mechanic->verified && $mechanic->latitude && $mechanic->longitude)
                            L.marker([{{ $mechanic->latitude }}, {{ $mechanic->longitude }}]).addTo(map)
                                .bindPopup(`
                                <div class="custom-popup">
                        <img src="{{ asset($mechanic->image) }}" alt="Mechanic Image">
                                    <h5>{{ $mechanic->shopname ?? $mechanic->name }}</h5>
                                    <p>{{ $mechanic->ContactNo }}</p>
                                    <p>{{ $mechanic->Address }}</p>
                                    <a href="{{ route('user.services', $mechanic->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-store-alt mr-1"></i> View Shop
                                    </a>
                                </div>
                            `);
                    @endif
            @endforeach

        });
    </script>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

    <!-- Optional custom JS file -->
    <script src="{{ asset('assets/js/script1.js') }}"></script>
</body>

</html>