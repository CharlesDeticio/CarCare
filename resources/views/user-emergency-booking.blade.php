<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Emergency Booking - User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .search-container {
            margin-bottom: 15px;
        }

        #pac-input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background: #f9fafb;
        }

        .autocomplete-suggestions {
            border: 1px solid #ccc;
            border-top: none;
            max-height: 200px;
            overflow-y: auto;
            position: absolute;
            width: 100%;
            z-index: 1000;
            background: white;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .autocomplete-suggestion {
            padding: 10px;
            cursor: pointer;
            font-size: 14px;
            color: #333;
        }

        .autocomplete-suggestion:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>

    <x-usersidebar />

    <div class="container">
        <h1>Emergency Booking</h1>

        <!-- Search Bar -->
        <div class="search-container">
            <input id="pac-input" type="text" placeholder="Search for an address..." class="form-control">
            <div id="autocomplete-results" class="autocomplete-suggestions"></div>
        </div>

        <!-- Locate Me Button -->
        <button type="button" id="locateMeBtn" style="margin-bottom: 15px;" class="btn btn-secondary">
            <i class="fas fa-crosshairs"></i> Use My Current Location
        </button>

        <!-- Map -->
        <div id="map"></div>

        <!-- Emergency Booking Form -->
        <form id="emergencyForm">
            @csrf
            <div class="form-group">
                <label for="emergency_reason">Emergency Reason</label>
                <textarea id="emergency_reason" name="emergency_reason" required></textarea>
            </div>
            <input type="hidden" id="latitude" name="latitude" required>
            <input type="hidden" id="longitude" name="longitude" required>

            <div class="form-group">
                <label for="emergency_address">Address</label>
                <input type="text" id="emergency_address" name="emergency_address" readonly required>
            </div>

            <button type="submit" id="submitBtn">Submit Emergency Booking</button>
        </form>
    </div>

    <!-- JavaScript Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const defaultLat = 10.312537;
            const defaultLng = 123.960223;

            const map = L.map('map').setView([defaultLat, defaultLng], 12);

            L.tileLayer('https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=gPDa74mAZTitZuCiw7vl', {
                attribution: '&copy; <a href="https://www.maptiler.com/">MapTiler</a> contributors'
            }).addTo(map);

            const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

            marker.on('dragend', function (event) {
                const position = event.target.getLatLng();
                updateLatLng(position.lat, position.lng);
                reverseGeocode(position.lat, position.lng);
            });

            function updateLatLng(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }

            function reverseGeocode(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('emergency_address').value = data.display_name || "Address not found";
                    });
            }

            reverseGeocode(defaultLat, defaultLng);
            updateLatLng(defaultLat, defaultLng);

            // Autocomplete for search bar
            const searchInput = document.getElementById('pac-input');
            const autocompleteResults = document.getElementById('autocomplete-results');

            searchInput.addEventListener('input', function () {
                const query = searchInput.value;

                if (query.length > 2) {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            autocompleteResults.innerHTML = '';

                            if (data.length === 0) {
                                autocompleteResults.innerHTML = '<div class="autocomplete-suggestion">No results found</div>';
                            }

                            data.forEach(result => {
                                const suggestion = document.createElement('div');
                                suggestion.className = 'autocomplete-suggestion';
                                suggestion.textContent = result.display_name;

                                suggestion.addEventListener('click', () => {
                                    searchInput.value = result.display_name;
                                    autocompleteResults.innerHTML = '';

                                    const latlng = [parseFloat(result.lat), parseFloat(result.lon)];
                                    map.setView(latlng, 14);
                                    marker.setLatLng(latlng);

                                    updateLatLng(result.lat, result.lon);
                                    document.getElementById('emergency_address').value = result.display_name;
                                });

                                autocompleteResults.appendChild(suggestion);
                            });
                        });
                } else {
                    autocompleteResults.innerHTML = '';
                }
            });

            document.addEventListener('click', function (event) {
                if (!searchInput.contains(event.target)) {
                    autocompleteResults.innerHTML = '';
                }
            });

            // Locate Me Button Click Handler
            document.getElementById('locateMeBtn').addEventListener('click', function () {
                if (!navigator.geolocation) {
                    Swal.fire('Error', 'Geolocation is not supported by your browser.', 'error');
                    return;
                }

                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        marker.setLatLng([lat, lng]);
                        map.setView([lat, lng], 14);

                        updateLatLng(lat, lng);
                        reverseGeocode(lat, lng);

                        Swal.fire({
                            icon: 'success',
                            title: 'Location Found!',
                            text: 'Pin updated to your current location.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    function (error) {
                        Swal.fire('Error', 'Unable to retrieve your location.', 'error');
                        console.error(error);
                    }
                );
            });
        });

        // Submit emergency booking with confirmation
        document.getElementById("emergencyForm").addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Confirm?',
                text: "Once you submit, you will not be able to cancel it.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit!'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitEmergencyBooking();
                }
            });
        });

        async function submitEmergencyBooking() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            const data = {
                emergency_reason: document.getElementById("emergency_reason").value,
                latitude: document.getElementById("latitude").value,
                longitude: document.getElementById("longitude").value,
                emergency_address: document.getElementById("emergency_address").value,
            };

            try {
                const response = await fetch("{{ route('emergency-booking.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();

                if (response.ok) {
                    Swal.fire({
                        title: 'Success!',
                        text: result.message || "Emergency booking created successfully!",
                        icon: 'success'
                    }).then(() => {
                        document.getElementById("emergencyForm").reset();
                    });
                } else {
                    Swal.fire('Error', result.message || "Failed to create emergency booking.", 'error');
                }

            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'An error occurred while submitting the form.', 'error');
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

    <!-- Optional custom JS -->
    <script src="{{ asset('assets/js/script1.js') }}"></script>
</body>

</html>
