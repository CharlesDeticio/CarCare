<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --danger-color: #f72585;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --white-color: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
            color: var(--dark-color);
            line-height: 1.6;
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--primary-color);
            color: var(--white-color);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-links {
            display: flex;
            gap: 1.5rem;
        }

        .navbar-link {
            color: var(--white-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .navbar-link.active {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        /* Notification Styles */
        .notification-container {
            position: relative;
        }

        .notification-bell {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--white-color);
            font-size: 1.25rem;
            position: relative;
            transition: var(--transition);
            padding: 0.5rem;
            border-radius: 50%;
        }

        .notification-bell:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger-color);
            color: var(--white-color);
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 50%;
            font-weight: bold;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 3.5rem;
            background: var(--white-color);
            color: var(--dark-color);
            list-style: none;
            padding: 0;
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            width: 350px;
            max-height: 500px;
            overflow-y: auto;
            z-index: 1001;
        }

        .notification-dropdown.show {
            display: block;
        }

        .notification-header {
            font-weight: 600;
            padding: 1rem;
            background-color: var(--light-color);
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
        }

        .notification-item {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            border-bottom: 1px solid #eee;
            transition: var(--transition);
            cursor: pointer;
        }

        .notification-item:hover {
            background-color: var(--light-color);
        }

        .notification-time {
            color: var(--gray-color);
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: block;
        }

        /* Logout Button */
        .logout-btn {
            background: none;
            color: var(--white-color);
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background-color: var(--white-color);
            padding: 1.5rem 2rem;
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .page-subtitle {
            font-size: 1rem;
            color: var(--gray-color);
            font-weight: 400;
        }

        /* Search Bar */
        .search-container {
            position: relative;
            margin-bottom: 2rem;
            max-width: 600px;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            transition: var(--transition);
            background-color: var(--white-color);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        /* Table Styles */
        .table-container {
            background-color: var(--white-color);
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .table th {
            background-color: var(--primary-color);
            color: var(--white-color);
            padding: 1rem;
            text-align: left;
            font-weight: 500;
            position: sticky;
            top: 0;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .table tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
            cursor: pointer;
        }

        /* Avatar */
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-color);
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Action Buttons */
        .action-btn {
            padding: 0.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: var(--white-color);
        }

        .btn-danger:hover {
            background-color: #d11440;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray-color);
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ddd;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .navbar-links {
                width: 100%;
                flex-direction: column;
                gap: 0.5rem;
            }

            .navbar-actions {
                width: 100%;
                justify-content: space-between;
            }

            .container {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .table td, .table th {
                padding: 0.75rem;
            }
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--white-color);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-brand">Admin Dashboard</a>

        <div class="navbar-links">
            
            <a href="#" class="navbar-link active">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="{{ route('admin.dashboard') }}" class="navbar-link">
                <i class="fas fa-user-cog"></i> Shop
            </a>
            
            <a href="{{ route('adminreport') }}" class="navbar-link">
                <i class="fas fa-flag"></i> Reports
            </a>
        </div>
        
        <div class="navbar-actions">
            <div class="notification-container">
                <button id="notificationBell" class="notification-bell">
                    <i class="fas fa-bell"></i>
                    @if ($adminUnreadCount > 0)
                        <span id="notifBadge" class="notification-badge">{{ $adminUnreadCount }}</span>
                    @endif
                </button>
                
                <ul id="notificationDropdown" class="notification-dropdown">
                    <li class="notification-header">
                        <span>Notifications</span>
                        <button id="markAllRead" class="btn btn-sm" style="padding: 0.25rem 0.5rem; background: rgba(0,0,0,0.1); border: none; border-radius: 4px; cursor: pointer;">Mark all as read</button>
                    </li>
                    <div id="notificationList">
                        @foreach ($adminNotifications as $notification)
                            <li class="notification-item" onclick="handleNotificationClick(event, {{ $notification->id }})">
                                <div>{{ $notification->message }}</div>
                                <small class="notification-time">{{ $notification->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                        @if($adminNotifications->isEmpty())
                            <li class="notification-item" style="text-align: center; color: var(--gray-color);">
                                No new notifications
                            </li>
                        @endif
                    </div>
                </ul>
            </div>
            
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="header">
            <div>
                <h1 class="page-title">User Accounts Management</h1>
                <p class="page-subtitle">Manage all registered user accounts</p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" class="search-input" placeholder="Search users by name, email, or phone..." onkeyup="searchTable()">
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr onclick="window.location='{{ route('admin.user.view', $user->id) }}'">
                            <td>#{{ $user->id }}</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div class="avatar" style="background-image:url('{{ $user->image ? asset('upload/' . $user->image) : asset('img/avatar.png') }}'); background-size: cover;">
                                        @if(!$user->image)
                                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight: 500;">{{ $user->first_name }} {{ $user->last_name }}</div>
                                        <div style="font-size: 0.75rem; color: var(--gray-color);">Last updated: {{ $user->updated_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->phone_number }}</td>
                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $user->address }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-danger" title="Delete User" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this user?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($users->isEmpty())
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-user-slash"></i>
                                    </div>
                                    <h3>No User Accounts Found</h3>
                                    <p>There are currently no users registered in the system.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Notification Handling
        document.addEventListener('DOMContentLoaded', function() {
            const notificationBell = document.getElementById('notificationBell');
            const notificationDropdown = document.getElementById('notificationDropdown');
            
            // Toggle dropdown when clicking the bell
            notificationBell.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('show');
                
                // Hide badge when dropdown is shown
                const badge = document.getElementById('notifBadge');
                if (badge && notificationDropdown.classList.contains('show')) {
                    badge.style.display = 'none';
                    markNotificationsAsRead();
                }
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!notificationDropdown.contains(e.target) && !notificationBell.contains(e.target)) {
                    notificationDropdown.classList.remove('show');
                }
            });
            
            // Prevent dropdown from closing when clicking inside it
            notificationDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
            
            // Mark all as read functionality
            document.getElementById('markAllRead')?.addEventListener('click', function(e) {
                e.stopPropagation();
                markNotificationsAsRead();
            });
        });
        
        function markNotificationsAsRead() {
            fetch('{{ route("admin.notifications.markAllRead") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    const badge = document.getElementById('notifBadge');
                    if (badge) badge.style.display = 'none';
                }
            });
        }
        
        function handleNotificationClick(event, notificationId) {
            event.stopPropagation();
            
            // Mark this specific notification as read
            fetch(`/admin/notifications/${notificationId}/mark-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            
            // Close the dropdown after click
            document.getElementById('notificationDropdown').classList.remove('show');
        }

        // Search function
        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("userTable");
            const trs = table.getElementsByTagName("tr");

            for (let i = 1; i < trs.length; i++) {
                const tds = trs[i].getElementsByTagName("td");
                let match = false;
                
                for (let j = 0; j < tds.length; j++) {
                    if (tds[j]) {
                        const txtValue = tds[j].textContent || tds[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                
                trs[i].style.display = match ? "" : "none";
            }
        }

        // Fetch new notifications periodically
        function fetchAdminNotifications() {
            fetch('{{ route("admin.notifications.fetch") }}')
                .then(response => response.json())
                .then(data => {
                    const list = document.getElementById('notificationList');
                    const badge = document.getElementById('notifBadge');

                    // Clear current list
                    list.innerHTML = '';

                    // Add header
                    const header = document.createElement('li');
                    header.className = 'notification-header';
                    header.innerHTML = `
                        <span>Notifications</span>
                        <button id="markAllRead" class="btn btn-sm" style="padding: 0.25rem 0.5rem; background: rgba(0,0,0,0.1); border: none; border-radius: 4px; cursor: pointer;">Mark all as read</button>
                    `;
                    list.appendChild(header);

                    // Render notifications
                    if (data.notifications.length > 0) {
                        data.notifications.forEach(notification => {
                            const li = document.createElement('li');
                            li.className = 'notification-item';
                            li.setAttribute('onclick', `handleNotificationClick(event, ${notification.id})`);
                            li.innerHTML = `
                                <div>${notification.message}</div>
                                <small class="notification-time">${timeAgo(notification.created_at)}</small>
                            `;
                            list.appendChild(li);
                        });
                    } else {
                        const li = document.createElement('li');
                        li.className = 'notification-item';
                        li.style.textAlign = 'center';
                        li.style.color = 'var(--gray-color)';
                        li.textContent = 'No new notifications';
                        list.appendChild(li);
                    }

                    // Update badge
                    if (badge) {
                        if (data.unread_count > 0) {
                            badge.style.display = 'inline-block';
                            badge.textContent = data.unread_count;
                        } else {
                            badge.style.display = 'none';
                        }
                    }
                });
        }

        // Convert timestamp to "x minutes ago"
        function timeAgo(dateString) {
            const now = new Date();
            const then = new Date(dateString);
            const secondsAgo = Math.floor((now - then) / 1000);

            if (secondsAgo < 60) return 'Just now';
            if (secondsAgo < 3600) return `${Math.floor(secondsAgo / 60)} mins ago`;
            if (secondsAgo < 86400) return `${Math.floor(secondsAgo / 3600)} hrs ago`;
            return then.toLocaleDateString();
        }

        // Poll every 10 seconds for new notifications
        setInterval(fetchAdminNotifications, 10000);
    </script>
</body>
</html>