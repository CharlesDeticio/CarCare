<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Shop Accounts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
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

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--white-color);
            text-decoration: none;
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

        /* Notification Styles - Fixed Positioning */
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
            z-index: 1001; /* Higher than dropdown */
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
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%; /* Position below the bell */
            background: var(--white-color);
            color: var(--dark-color);
            list-style: none;
            padding: 0;
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            width: 350px;
            max-height: 500px;
            overflow-y: auto;
            z-index: 1002; /* Higher than bell */
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
            z-index: 1;
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

        /* Rest of your existing CSS remains the same */
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

        /* Main Content Styles */
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

        /* Search and Filter */
        .search-filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-container {
            position: relative;
            flex-grow: 1;
            max-width: 500px;
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

        .filter-container {
            display: flex;
            gap: 1rem;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            background-color: var(--white-color);
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-btn:hover {
            background-color: var(--light-color);
        }

        .filter-btn.active {
            background-color: var(--primary-color);
            color: var(--white-color);
            border-color: var(--primary-color);
        }

        /* Alert Messages */
        .alert {
            width: 100%;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 0.5rem;
            color: var(--white-color);
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background-color: var(--success-color);
        }

        .alert-error {
            background-color: var(--danger-color);
        }

        .alert-info {
            background-color: var(--primary-color);
        }

        .alert-close {
            margin-left: auto;
            cursor: pointer;
            background: none;
            border: none;
            color: inherit;
            font-size: 1.25rem;
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

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-denied {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-success {
            background-color: #28a745;
            color: var(--white-color);
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: var(--white-color);
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: var(--white-color);
        }

        .btn-warning:hover {
            background-color: #e07d10;
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

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-item {
            list-style: none;
        }

        .page-link {
            display: block;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .page-link:hover {
            background-color: var(--light-color);
        }

        .page-link.active {
            background-color: var(--primary-color);
            color: var(--white-color);
            border-color: var(--primary-color);
        }

        .page-link.disabled {
            color: var(--gray-color);
            pointer-events: none;
            background-color: var(--light-color);
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

            .notification-dropdown {
                width: 280px;
            }

            .container {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-filter-container {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-container {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
        }

        /* Animation for notification badge */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 1s infinite;
        }    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-brand">Admin Dashboard</a>
        
        <div class="navbar-links">
            <a href="{{ route('admin.indexuser') }}" class="navbar-link">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="{{ route('admin.dashboard') }}" class="navbar-link active">
                <i class="fas fa-store"></i> Shops
            </a>
            
            <a href="{{ route('admin.reports.index') }}" class="navbar-link">
                <i class="fas fa-flag"></i> Reports
            </a>
        </div>
        
        <div class="navbar-actions">
            <div class="notification-container">
                <button id="notificationBell" class="notification-bell">
                    <i class="fas fa-bell"></i>
                    @if ($adminUnreadCount > 0)
                        <span id="notifBadge" class="notification-badge pulse">{{ $adminUnreadCount }}</span>
                    @endif
                </button>
                
                <ul id="notificationDropdown" class="notification-dropdown">
                    <li class="notification-header">
                        <span>Notifications</span>
                        <button id="markAllRead" class="btn btn-sm" style="padding: 0.25rem 0.5rem; background: rgba(255,255,255,0.2);">Mark all as read</button>
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
        <!-- Your existing content remains the same -->
<div class="container">
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button class="alert-close">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button class="alert-close">&times;</button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                {{ session('info') }}
                <button class="alert-close">&times;</button>
            </div>
        @endif

        <!-- Page Header -->
        <div class="header">
            <div>
                <h1 class="page-title">Shop Accounts Management</h1>
                <p class="page-subtitle">Manage and review all registered mechanic shops</p>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="search-filter-container">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Search shops by name, email, or location..." onkeyup="searchTable()">
            </div>
            
            <div class="filter-container">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-list"></i> All
                </button>
                <button class="filter-btn" data-filter="pending">
                    <i class="fas fa-clock"></i> Pending
                </button>
                <button class="filter-btn" data-filter="approved">
                    <i class="fas fa-check-circle"></i> Approved
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Shop</th>
                        <th>Owner</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mechanics as $mechanic)
                        <tr onclick="window.location='{{ route('admin.mechanic.view', $mechanic->id) }}'" style="cursor: pointer;">
                            <td>#{{ $mechanic->id }}</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div class="avatar">
                                        @if($mechanic->shopname)
                                            {{ substr($mechanic->shopname, 0, 1) }}
                                        @else
                                            <i class="fas fa-store"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight: 500;">{{ $mechanic->shopname ?? 'No Shop Name' }}</div>
                                        <div style="font-size: 0.75rem; color: var(--gray-color);">{{ $mechanic->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $mechanic->name }}</td>
                            <td>{{ $mechanic->ContactNo }}</td>
                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $mechanic->Address }}</td>
                            <td>
                                @if(!$mechanic->verified)
                                    <span class="status-badge status-pending">Pending Approval</span>
                                @else
                                    <span class="status-badge status-approved">Approved</span>
                                @endif
                            </td>
                            <td>{{ $mechanic->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="action-btns">
                                    @if(!$mechanic->verified)
                                        <form action="{{ route('admin.approveMechanic', $mechanic->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="event.stopPropagation()">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.denyMechanic', $mechanic->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.stopPropagation()">
                                                <i class="fas fa-times"></i> Deny
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-primary btn-sm" onclick="event.stopPropagation(); window.location='{{ route('admin.mechanic.view', $mechanic->id) }}'">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if($mechanics->isEmpty())
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-store-slash"></i>
                                    </div>
                                    <h3>No Shop Accounts Found</h3>
                                    <p>There are currently no mechanic shops registered in the system.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        
    </div>
    </div>

    <script>
        // Toggle notifications dropdown
        function toggleNotifications() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.toggle('show');
            
            // Hide badge when dropdown is shown
            const badge = document.getElementById('notifBadge');
            if (badge && dropdown.classList.contains('show')) {
                badge.style.display = 'none';
            }
            
            // Mark all as read via AJAX
            if (dropdown.classList.contains('show')) {
                fetch('{{ route("admin.notifications.markAllRead") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });
            }
        }

        // Close notifications when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('notificationDropdown');
            const bell = document.getElementById('notificationBell');
            
            if (!dropdown.contains(event.target) && !bell.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Mark all as read button
        document.getElementById('markAllRead')?.addEventListener('click', function(e) {
            e.stopPropagation();
            fetch('{{ route("admin.notifications.markAllRead") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                const badge = document.getElementById('notifBadge');
                if (badge) badge.style.display = 'none';
            });
        });

        // Close alert messages
        document.querySelectorAll('.alert-close').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.style.display = 'none';
            });
        });

        // Filter table by status
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active button
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                const rows = document.querySelectorAll('#userTable tbody tr');
                
                rows.forEach(row => {
                    const status = row.querySelector('.status-badge')?.textContent.toLowerCase();
                    
                    if (filter === 'all') {
                        row.style.display = '';
                    } else if (filter === 'pending' && status?.includes('pending')) {
                        row.style.display = '';
                    } else if (filter === 'approved' && status?.includes('approved')) {
                        row.style.display = '';
                    } else if (filter !== 'all') {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Search table function
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
            fetch('{{ route('admin.notifications.fetch') }}')
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
                        <button id="markAllRead" class="btn btn-sm" style="padding: 0.25rem 0.5rem; background: rgba(255,255,255,0.2);">Mark all as read</button>
                    `;
                    list.appendChild(header);

                    // Render notifications
                    if (data.notifications.length > 0) {
                        data.notifications.forEach(notification => {
                            const li = document.createElement('li');
                            li.className = 'notification-item';
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
                            badge.classList.add('pulse');
                        } else {
                            badge.style.display = 'none';
                            badge.classList.remove('pulse');
                        }
                    }

                    // Reattach mark all as read event
                    document.getElementById('markAllRead')?.addEventListener('click', function(e) {
                        e.stopPropagation();
                        fetch('{{ route("admin.notifications.markAllRead") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        }).then(() => {
                            if (badge) badge.style.display = 'none';
                        });
                    });
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

        document.addEventListener('DOMContentLoaded', function () {
    const bell = document.getElementById('notificationBell');
    bell?.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent it from closing immediately due to the outside click handler
        toggleNotifications();
    });
});

    </script>
</body>
</html>