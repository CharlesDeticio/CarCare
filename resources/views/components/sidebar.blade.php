<!-- navbar -->
<nav class="navbar">
  <div class="logo_item">
    <i class="bx bx-menu" id="sidebarOpen"></i>
        <img src="{{ asset('images/carcare.avif') }}" alt="Logo">Carcare
  </div>

  @php
  $mechanic = auth()->guard('mechanic')->user();
@endphp

{{-- ✅ Admin Approval Notification --}}
@if ($mechanic && $mechanic->hasVerifiedEmail() && !$mechanic->verified)
  <div style="
      width: 100%;
      background-color: #fff3cd;
      color: #856404;
      padding: 10px 20px;
      border: 1px solid #ffeeba;
      border-radius: 4px;
      margin-bottom: 15px;
      font-size: 14px;
      position: absolute;
      top: 60px; /* Below navbar */
      left: 0;
      z-index: 1000;
      text-align: center;">
    ✅ Your email is verified! Please wait for the admin to approve your account before your shop becomes visible.
  </div>
@endif

  @php
    $mechanic = auth()->guard('mechanic')->user();
  @endphp
  <div class="navbar_content">
    <i class="bi bi-grid"></i>
    <i class='bx bx-sun' id="darkLight"></i>
    <a class="nav-link" href="{{ route('mechanic.profile', $mechanic->id) }}">
      <img 
      src="{{ $mechanic && $mechanic->image ? asset($mechanic->image) : asset('img/avatar.png') }}" 
      alt="{{ $mechanic->shopname }}" 
        class="profile" 
        style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
    </a>    
    <a href="{{ route('mechanic.notifications') }}">
      <i class='bx bx-bell'></i>
      <span class="notification-badge" id="mechanic-order-notification-count" style="display: none;">0</span>
    </a>  
  </div>
</nav>

<!-- sidebar -->
<nav class="sidebar">
  <div class="menu_content">
    <ul class="menu_items">
      <div class="menu_title menu_dashboard">
        <i class="bx bx-home"></i> Dashboard
      </div>

      
      <li class="item">
        <a href="{{ route('mechanic.overview') }}" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-bar-chart"></i>
          </span>
          <span class="navlink">Overview</span>
        </a>
      </li>

      <!--<li class="item position-relative">-->
      <!--  <a href="{{ route('mechanic-emergency-booking') }}" class="nav_link" id="emergencyMapLink">-->
      <!--    <span class="navlink_icon position-relative">-->
      <!--      <i class="bx bxs-map"></i>-->
      <!--      <span class="notification-badge" id="emergencyMapNotificationCount" style="display: none;">0</span>-->
      <!--    </span>-->
      <!--    <span class="navlink">Emergency Map</span>-->
      <!--  </a>-->
      <!--</li>-->
      
      <li class="item">
        <a href="{{ route('mechanic.dashboard') }}" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-list-ul"></i>
          </span>
          <span class="navlink">Service List</span>
        </a>
      </li>

      <li class="item">
        <a href="{{ route('mechanic.productdashboard') }}" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-package"></i>
          </span>
          <span class="navlink">Product List</span>
        </a>
      </li>
    </ul>

    <ul class="menu_items">
      

      <!-- Booking List -->
      <li class="item">
        <div class="nav_link submenu_item">
          <span class="navlink_icon">
            <i class="bx bx-book"></i>
          </span>
          <span class="navlink">Booking Request</span>
          <i class="bx bx-chevron-down arrow-left"></i>
        </div>

        <ul class="menu_items submenu">
          <a href="{{ route('mechanic.bookings', ['status' => 'pending']) }}" class="nav_link sublink">
            <i class="bx bx-time"></i> Bookings
          </a>
          <!--<a href="{{ route('mechanic.emergency.bookings.status') }}" class="nav_link sublink">-->
          <!--  <i class="bx bx-first-aid"></i> Emergency Book-->
          <!--</a>-->
        </ul>
        </li>
        
      
      <!-- Orders -->
      <li class="item">
        <div class="nav_link submenu_item">
          <span class="navlink_icon">
            <i class="bx bx-cart"></i>
          </span>
          <span class="navlink">Orders Request</span>
          <i class="bx bx-chevron-down arrow-left"></i>
        </div>

        <ul class="menu_items submenu">
          <a href="{{ route('mechanic.orders', ['status' => 'pending']) }}" class="nav_link sublink">
            <i class="bx bx-hourglass"></i> Pending
          </a>
          <a href="{{ route('mechanic.orders', ['status' => 'completed']) }}" class="nav_link sublink">
            <i class="bx bx-check-circle"></i> Completed
          </a>
          <a href="{{ route('mechanic.orders', ['status' => 'denied']) }}" class="nav_link sublink">
            <i class="bx bx-x-circle"></i> Canceled
          </a>
        </ul>
      </li>

      <!-- Chat -->
      {{-- <li class="item">
        <a href="{{ route('mechanic.messages.chatList') }}" class="nav_link" id="mechanicChatLink">
          <span class="navlink_icon"><i class="bx bx-chat"></i></span>
          <span class="navlink">Chat</span>
          <span class="notification-badge" id="chatNotificationCountMechanic" style="display: none;">0</span>
        </a>
        
      </li> --}}

      <li class="item">
        <a href="{{ route('mechanic.ratings') }}" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-bar-chart"></i>
          </span>
          <span class="navlink">Rates and Reviews</span>
        </a>
      </li>
      


      <!-- Logout -->
      <li class="item">
        <form id="logout-form" action="{{ route('mechanic.logout') }}" method="POST">
          @csrf
          <button type="submit" class="nav_link" style="background: none; border: none; cursor: pointer;">
            <span class="navlink_icon">
              <i class="bx bx-log-out"></i>
            </span>
            <span class="navlink">Logout</span>
          </button>
        </form>
      </li>
    </ul>

    <!-- Sidebar Open / Close -->
    {{-- <div class="bottom_content">
      <div class="bottom expand_sidebar">
        <i class='bx bx-expand-horizontal'></i> <span>Expand</span>
      </div>
      <div class="bottom collapse_sidebar">
        <i class='bx bx-collapse-horizontal'></i> <span>Collapse</span>
      </div>
    </div> --}}
  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const rows = document.querySelectorAll('.clickable-row');
      rows.forEach(row => {
          row.addEventListener('click', function () {
              const href = this.getAttribute('data-href');
              if (href) {
                  window.location.href = href;
              }
          });
      });

      fetchUnreadOrderNotifications();

      function fetchUnreadOrderNotifications() {
          fetch("{{ route('mechanic.orders.unread') }}")
              .then(response => response.json())
              .then(data => {
                  let count = data.unread_count;
                  let badge = document.getElementById("mechanic-order-notification-count");

                  if (count > 0) {
                      badge.textContent = count;
                      badge.style.display = "inline-block";

                      // Add bounce animation
                      badge.classList.add("bounce");

                      setTimeout(() => {
                          badge.classList.remove("bounce");
                      }, 400);
                  } else {
                      badge.style.display = "none";
                  }
              })
              .catch(error => console.error("Error fetching notifications:", error));
      }

      document.querySelector(".order-menu")?.addEventListener("click", function () {
          fetch("{{ route('mechanic.notifications.markAllRead') }}", {
              method: "POST",
              headers: {
                  "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  "Content-Type": "application/json",
              },
          })
              .then(response => response.json())
              .then(data => {
                  if (data.success) {
                    document.getElementById("mechanic-order-notification-count").style.display = "none";
                  }
              })
              .catch(error => console.error("Error marking notifications as read:", error));
      });
  });

  // ✅ MECHANIC CHAT NOTIFICATIONS
  document.addEventListener("DOMContentLoaded", function () {

    const CSRF_TOKEN = "{{ csrf_token() }}";
    const CHAT_MARK_READ_ROUTE = "{{ route('mechanic.markChatAsRead') }}";
    const CHAT_NOTIFICATION_ROUTE = "{{ route('mechanic.getChatNotifications') }}";

    const chatLink = document.getElementById("mechanicChatLink");
    const chatBadge = document.getElementById("chatNotificationCountMechanic");

    // Poll unread chat notifications every 5 seconds
    fetchChatNotificationsMechanic();
    const chatInterval = setInterval(fetchChatNotificationsMechanic, 5000);

    function fetchChatNotificationsMechanic() {
        fetch(CHAT_NOTIFICATION_ROUTE)
            .then(response => response.json())
            .then(data => {
                const unreadCount = data.unread_count;
                console.log("Unread chat count:", unreadCount);

                if (unreadCount > 0) {
                    chatBadge.textContent = unreadCount;
                    chatBadge.style.display = "inline-block";
                } else {
                    chatBadge.style.display = "none";
                }
            })
            .catch(error => {
                console.error("Fetch chat notifications error:", error);
            });
    }

    // Chat link click
    if (chatLink) {
        chatLink.addEventListener("click", function (event) {
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
                    chatBadge.textContent = "";
                    chatBadge.style.display = "none";

                    // Navigate after marking read
                    window.location.href = "{{ route('mechanic.messages.chatList') }}";
                }
            })
            .catch(error => console.error("Error marking chat as read:", error));
        });
    }

  });

  fetchEmergencyNotifications();

function fetchEmergencyNotifications() {
    fetch("{{ route('mechanic.emergency.unread') }}")
        .then(response => response.json())
        .then(data => {
            let count = data.unread_count;
            let badge = document.getElementById("emergencyMapNotificationCount");

            if (count > 0) {
                badge.textContent = count;
                badge.style.display = "inline-block";
            } else {
                badge.style.display = "none";
            }
        })
        .catch(error => console.error("Error fetching emergency notifications:", error));
}

// Optional: refresh every 10 seconds
setInterval(fetchEmergencyNotifications, 10000);

// Optional: mark as read on click
document.getElementById("emergencyMapLink").addEventListener("click", function () {
    fetch("{{ route('mechanic.emergency.markAllRead') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        }
    });
});

function fetchEmergencyNotifications() {
  fetch("{{ route('mechanic.emergency.unread') }}")
    .then(response => response.json())
    .then(data => {
      let count = data.unread_count;
      let badge = document.getElementById("emergencyMapNotificationCount");

      if (count > 0) {
        badge.textContent = count;
        badge.style.display = "inline-block";
      } else {
        badge.style.display = "none";
      }
    })
    .catch(error => console.error("Error fetching emergency notifications:", error));
}

setInterval(fetchEmergencyNotifications, 10000);

document.addEventListener('DOMContentLoaded', function () {
    // CSRF and Routes
    const CSRF_TOKEN = "{{ csrf_token() }}";

    const routes = {
        ordersUnread: "{{ route('mechanic.orders.unread') }}",
        emergencyUnread: "{{ route('mechanic.emergency.unread') }}",
        chatUnread: "{{ route('mechanic.getChatNotifications') }}",
        markChatRead: "{{ route('mechanic.markChatAsRead') }}",
        markEmergencyRead: "{{ route('mechanic.emergency.markAllRead') }}"
    };

    // Elements
    const orderBadge = document.getElementById("mechanic-order-notification-count");
    const emergencyBadge = document.getElementById("emergencyMapNotificationCount");
    const chatBadge = document.getElementById("chatNotificationCountMechanic");

    // Fetch Functions
    function fetchNotification(route, badgeElement) {
        fetch(route)
            .then(res => res.json())
            .then(data => {
                const count = data.unread_count;
                if (count > 0) {
                    badgeElement.textContent = count;
                    badgeElement.style.display = "inline-block";
                    badgeElement.classList.add("bounce");
                    setTimeout(() => badgeElement.classList.remove("bounce"), 400);
                } else {
                    badgeElement.style.display = "none";
                }
            })
            .catch(err => console.error("Notification fetch error:", err));
    }

    // Polling every 10s
    setInterval(() => {
        fetchNotification(routes.ordersUnread, orderBadge);
        fetchNotification(routes.emergencyUnread, emergencyBadge);
        fetchNotification(routes.chatUnread, chatBadge);
    }, 10000);

    // On Emergency Map Click
    document.getElementById("emergencyMapLink")?.addEventListener("click", () => {
        fetch(routes.markEmergencyRead, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
                "Content-Type": "application/json"
            }
        });
    });

    // On Chat Link Click
    document.getElementById("mechanicChatLink")?.addEventListener("click", function (e) {
        e.preventDefault();
        fetch(routes.markChatRead, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
                "Content-Type": "application/json"
            }
        }).then(res => res.json()).then(data => {
            if (data.success) {
                chatBadge.style.display = "none";
                window.location.href = "{{ route('mechanic.messages.chatList') }}";
            }
        });
    });
});


</script>


<style>
.notification-badge {
    position: absolute;
    top: 2px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    display: none; /* initial state */
    z-index: 999;
}
.nav_link {
    position: relative; /* Add this if the badge isn't positioning correctly */
}



</style>
