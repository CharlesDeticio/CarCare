<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Emergency Booking Map</title>

    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">


    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        #map {
            height: 600px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 30px;
        }

        .container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  margin-left: 280px; /* Adjust based on sidebar width (was 260px) */
  transition: margin-left 0.3s ease;
  margin-top: 70px;
}

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .popup-button {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .popup-button:hover {
            background-color: #0056b3;
        }

        /* Notification Badge (separate styling) */
        .notification-badge {
            display: inline-block;
            min-width: 20px;
            padding: 4px 8px;
            font-size: 12px;
            font-weight: bold;
            color: #fff;
            background-color: #ff3b3b;
            border-radius: 12px;
            text-align: center;
            vertical-align: middle;
            margin-left: 8px;
            box-shadow: 0 0 8px rgba(255, 59, 59, 0.5);
            transition: transform 0.2s ease;
        }

        @keyframes bounce {
            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }

        .notification-badge.bounce {
            animation: bounce 0.4s;
        }

    </style>
</head>

<body>

    <!-- navbar -->
    <div class="sidebar-wrapper">
        <x-sidebar />
    </div>

    <!-- Main Content -->
    <div class="container">
        <h1 class="text-center mb-4">Emergency Bookings (Map View)</h1>
        <div class="text-center mt-4">
            <a href="{{ route('mechanic.emergency.bookings.status') }}" class="btn-secondary">View Booking List</a>
        </div>

        <div id="map"></div>

        
    </div>

    <script src="{{ asset('assets/js/script2.js') }}"></script>

    <!-- Mechanic Emergency Booking Map Logic -->
    <script>
        let map;
        let markers = [];
        const mechanicId = {{ auth()->guard('mechanic')->user()->id }};

        document.addEventListener('DOMContentLoaded', () => {
            initMap();
            fetchEmergencyBookings();
        });

        function initMap() {
            map = L.map('map').setView([10.312537, 123.960223], 12);

            L.tileLayer('https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=gPDa74mAZTitZuCiw7vl', {
                attribution: '&copy; <a href="https://www.maptiler.com/">MapTiler</a> contributors'
            }).addTo(map);
        }

        function clearMarkers() {
            markers.forEach(obj => map.removeLayer(obj.marker));
            markers = [];
        }

        async function fetchEmergencyBookings() {
            clearMarkers();

            try {
                const response = await fetch("{{ route('emergency-bookings') }}");
                const json = await response.json();
                const bookings = json.data;

                if (!bookings.length) {
                    console.log("No emergency bookings found.");
                    return;
                }

                bookings.forEach(booking => {
                    const lat = parseFloat(booking.latitude);
                    const lng = parseFloat(booking.longitude);

                    const markerIcon = L.icon({
                        iconUrl: 'https://cdn-icons-png.flaticon.com/512/484/484167.png',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    const marker = L.marker([lat, lng], { icon: markerIcon }).addTo(map);

                    updatePopupContent(marker, booking);

                    markers.push({ marker, booking });
                });

            } catch (error) {
                console.error("Error fetching bookings:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Could not load emergency bookings.'
                });
            }
        }

        function updatePopupContent(marker, booking) {
    let buttonAction = '';

    if (booking.status === 'pending') {
        buttonAction = `<button class="popup-button" onclick="confirmAccept(${booking.id})">Accept</button>`;
    } else if (booking.status === 'accepted' && booking.mechanic_id === mechanicId) {
        // CHANGE: Display a "View" button instead of "Complete"
        buttonAction = `
            <a href="/emergency-bookings/${booking.id}" 
               class="popup-button" 
               style="display: inline-block; text-align: center;">
                <i class="fas fa-eye"></i> View
            </a>
        `;
    } else if (booking.status === 'accepted') {
        buttonAction = `<p style="color: red;"><em>Accepted by another mechanic.</em></p>`;
    } else if (booking.status === 'completed') {
        buttonAction = `<p style="color: green;"><em>Completed</em></p>`;
    }

    const phoneNumber = booking.user?.phone_number ?? 'N/A';

    const popupContent = `
        <div style="max-width: 250px; word-wrap: break-word;">
            <strong>Emergency Reason:</strong><br>
            <div style="max-height: 80px; overflow-y: auto; padding: 4px; border: 1px solid #eee; border-radius: 4px;">
                ${booking.emergency_reason}
            </div><br>

            <strong>Phone No:</strong><br>
            <a href="tel:${phoneNumber}">${phoneNumber}</a><br><br>

            <strong>Address:</strong><br>
            ${booking.emergency_address}<br><br>

            ${buttonAction}
        </div>
    `;

    marker.bindPopup(popupContent);
}


        function confirmAccept(bookingId) {
            Swal.fire({
                title: 'Accept Emergency Booking?',
                icon: 'warning',
                text: 'Are you sure you want to accept this booking?',
                showCancelButton: true,
                confirmButtonText: 'Accept',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    acceptBooking(bookingId);
                }
            });
        }

        async function acceptBooking(bookingId) {
            try {
                const response = await fetch(`/emergency-booking/${bookingId}/accept`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ mechanic_id: mechanicId })
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Booking Accepted!',
                        text: data.message
                    });

                    refreshMarkers(bookingId, 'accepted');

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: data.message || "Failed to accept booking."
                    });
                }

            } catch (error) {
                console.error("Error accepting booking:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'An error occurred while accepting the booking.'
                });
            }
        }

        function confirmComplete(bookingId) {
            Swal.fire({
                title: 'Mark as Completed?',
                icon: 'info',
                text: 'Confirm service completion?',
                showCancelButton: true,
                confirmButtonText: 'Complete',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    completeBooking(bookingId);
                }
            });
        }

        async function completeBooking(bookingId) {
            try {
                const response = await fetch(`/emergency-booking/${bookingId}/complete`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ mechanic_id: mechanicId })
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Booking Completed!',
                        text: data.message
                    });

                    removeMarker(bookingId);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: data.message || "Failed to complete booking."
                    });
                }

            } catch (error) {
                console.error("Error completing booking:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'An error occurred while completing the booking.'
                });
            }
        }

        function refreshMarkers(bookingId, status) {
    markers.forEach(obj => {
        if (obj.booking.id === bookingId) {
            obj.booking.status = status;
            obj.booking.mechanic_id = mechanicId;

            // ✅ Update the popup to show the View button now!
            updatePopupContent(obj.marker, obj.booking);

            // ✅ Open popup automatically for instant feedback
            obj.marker.openPopup();
        }
    });
}


        function removeMarker(bookingId) {
            const markerObj = markers.find(obj => obj.booking.id === bookingId);
            if (markerObj) {
                map.removeLayer(markerObj.marker);
                markers = markers.filter(obj => obj.booking.id !== bookingId);
            }
        }

    </script>
      <script src="{{ asset('assets/js/script2.js') }}"></script>


</body>

</html>
