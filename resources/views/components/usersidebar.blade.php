{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carcare User Panel</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">

    
</head>

<body> --}}

    <style>
        .badge-danger {
            position: absolute;
            top: 8px;
            right: 0px;
            font-size: 12px;
        }
        .hidden {
            display: none !important;
        }
    </style>

<!-- Navbar -->
<nav class="navbar navbar-expand-custom navbar-mainbg">
    <a class="navbar-brand navbar-logo" href="{{ route('dashboard') }}">Carcare</a>

    <!-- Toggle button for mobile -->
    <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <div class="hori-selector"><div class="left"></div><div class="right"></div></div>

            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i> Shops
                </a>
            </li>

            <!-- Map -->
            <li class="nav-item {{ request()->routeIs('mechanics.map') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mechanics.map') }}">
                    <i class="fas fa-map"></i> Map
                </a>
            </li>

            <!-- Orders/Cart -->
            <li class="nav-item {{ request()->routeIs('user.pending') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.pending') }}">
                    <i class="fas fa-shopping-cart"></i> Orders / Cart
                </a>
            </li>

            <!-- My Bookings -->
            <li class="nav-item {{ request()->routeIs('user.bookings.pending') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.bookings.pending') }}">
                    <i class="fas fa-calendar-check"></i> My Bookings
                </a>
            </li>

            <!-- Emergency History -->
            <!--<li class="nav-item {{ request()->routeIs('user.emergency.bookings.status') ? 'active' : '' }}">-->
            <!--    <a class="nav-link" href="{{ route('user.emergency.bookings.status') }}">-->
            <!--        <i class="fas fa-calendar-check"></i> Emergency History-->
            <!--    </a>-->
            <!--</li>-->

            <!-- Chat -->
            {{-- <li class="nav-item {{ request()->routeIs('user.messages.chat') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.messages.chatList') }}" id="userChatLink">
                    <i class="fas fa-comments"></i> Chat
                    <span class="badge badge-danger hidden" id="chatNotificationCount">0</span>
                </a>
            </li> --}}

            <!-- Notifications -->
            <li class="nav-item {{ request()->routeIs('notifications.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('notifications.index') }}" id="notificationLink">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-danger hidden" id="notificationCount">0</span>
                </a>
            </li>

            <!-- Profile -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.show', Auth::user()->id) }}">
                    <img src="{{ Auth::user()->image ? asset('upload/' . Auth::user()->image) : asset('img/avatar.png') }}" 
                         alt="Profile Image"
                         style="width: 25px; height: 25px; border-radius: 50%; object-fit: cover;">
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <a class="nav-link">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<!-- JS LIBRARIES -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Chat & Notifications Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const CSRF_TOKEN = "{{ csrf_token() }}";

        const CHAT_MARK_READ_ROUTE = "{{ route('user.markChatAsRead') }}";
        const CHAT_NOTIFICATION_ROUTE = "{{ route('user.getChatNotifications') }}";

        const NOTIF_MARK_READ_ROUTE = "{{ route('user.markAllNotificationsAsRead') }}";
        const NOTIF_NOTIFICATION_ROUTE = "{{ route('user.getNotifications') }}";

        // Chat link click
        const userChatLink = document.getElementById("userChatLink");
        if (userChatLink) {
            userChatLink.addEventListener("click", function (event) {
                event.preventDefault();

                fetch(CHAT_MARK_READ_ROUTE, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const chatBadge = document.getElementById("chatNotificationCount");
                        chatBadge.textContent = "";
                        chatBadge.classList.add("hidden");

                        window.location.href = "{{ route('user.messages.chatList') }}";
                    }
                })
                .catch(error => console.error("Error marking chat as read:", error));
            });
        }

        // Notification link click
        const notificationLink = document.getElementById("notificationLink");
        if (notificationLink) {
            notificationLink.addEventListener("click", function (event) {
                event.preventDefault();

                fetch(NOTIF_MARK_READ_ROUTE, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notifBadge = document.getElementById("notificationCount");
                        notifBadge.textContent = "";
                        notifBadge.classList.add("hidden");

                        window.location.href = "{{ route('notifications.index') }}";
                    }
                })
                .catch(error => console.error("Error marking notifications as read:", error));
            });
        }

        // Polling for both chat and general notifications
        fetchChatNotifications();
        fetchGeneralNotifications();

        setInterval(fetchChatNotifications, 5000);
        setInterval(fetchGeneralNotifications, 5000);

        function fetchChatNotifications() {
            fetch(CHAT_NOTIFICATION_ROUTE)
                .then(response => response.json())
                .then(data => {
                    const chatBadge = document.getElementById("chatNotificationCount");
                    if (data.unread_count > 0) {
                        chatBadge.textContent = data.unread_count;
                        chatBadge.classList.remove("hidden");
                    } else {
                        chatBadge.textContent = "";
                        chatBadge.classList.add("hidden");
                    }
                })
                .catch(error => console.error("Error fetching chat notifications:", error));
        }

        function fetchGeneralNotifications() {
            fetch(NOTIF_NOTIFICATION_ROUTE)
                .then(response => response.json())
                .then(data => {
                    const notifBadge = document.getElementById("notificationCount");
                    if (data.unread_count > 0) {
                        notifBadge.textContent = data.unread_count;
                        notifBadge.classList.remove("hidden");
                    } else {
                        notifBadge.textContent = "";
                        notifBadge.classList.add("hidden");
                    }
                })
                .catch(error => console.error("Error fetching notifications:", error));
        }

    });
</script>

{{-- </body>
</html> --}}
