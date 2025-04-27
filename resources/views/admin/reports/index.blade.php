<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Analytics Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-dark: #4338CA;
            --secondary-color: #10B981;
            --danger-color: #EF4444;
            --warning-color: #F59E0B;
            --light-color: #F9FAFB;
            --dark-color: #111827;
            --gray-color: #6B7280;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F3F4F6;
            color: var(--dark-color);
        }

        .custom-navbar {
            background-color: var(--primary-color);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: white;
            text-decoration: none;
        }

        .navbar-links {
            display: flex;
            gap: 1.5rem;
        }

        .navbar-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.3s;
        }

        .navbar-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .navbar-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            position: relative;
        }

        .notification-container {
            position: relative;
        }

        .notification-bell {
            background: none;
            border: none;
            color: white;
            font-size: 1.25rem;
            cursor: pointer;
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background-color: var(--danger-color);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 50%;
            font-weight: bold;
        }

        .logout-btn {
            background: none;
            border: none;
            color: white;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 130%;
            background: white;
            color: var(--dark-color);
            list-style: none;
            padding: 0;
            border-radius: 0.5rem;
            box-shadow: var(--card-shadow);
            width: 300px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1002;
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
        }

        .notification-item {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .notification-item:hover {
            background-color: var(--light-color);
        }

        .notification-time {
            font-size: 0.75rem;
            color: var(--gray-color);
        }

        .stat-card {
            border-radius: 12px;
            border: none;
            transition: var(--transition);
            height: 100%;
            background-color: white;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card .card-body {
            padding: 1.5rem;
        }

        .stat-title {
            font-size: 1rem;
            font-weight: 500;
            color: var(--gray-color);
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .stat-change {
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .stat-change.positive {
            color: var(--secondary-color);
        }

        .stat-change.negative {
            color: var(--danger-color);
        }

        .chart-container {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.75rem;
            }

            .navbar-links {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="custom-navbar">
    <a href="#" class="navbar-brand">Admin Dashboard</a>
    <div class="navbar-links">
        <a href="{{ route('admin.indexuser') }}" class="navbar-link "><i class="fas fa-users"></i> Users</a>
        <a href="{{ route('admin.dashboard') }}" class="navbar-link"><i class="fas fa-store"></i> Shop</a>
        <a href="{{ route('adminreport') }}" class="navbar-link active"><i class="fas fa-flag"></i> Reports</a>
    </div>
    <div class="navbar-actions">
        
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </button>
        </form>    
    </div>
</nav>

<!-- Content -->
<div class="container py-4">
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="stat-title">Total Users</h6>
                            <h2 class="stat-value">{{ $totalUsers }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                    </div>
                    <!--<div class="stat-change positive">-->
                    <!--    <i class="fas fa-arrow-up me-1"></i> 12% from last month-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="stat-title">Verified Shops</h6>
                            <h2 class="stat-value">{{ $totalMechanics }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-tools text-success"></i>
                        </div>
                    </div>
                    <!--<div class="stat-change positive">-->
                    <!--    <i class="fas fa-arrow-up me-1"></i> 8% from last month-->
                    <!--</div>-->
                </div>
            </div>
        </div>

        <!-- PDF Button -->
        <div class="col-12 d-flex justify-content-center">
            <a href="{{ route('admin.reports.pdf') }}" class="btn btn-primary mt-2">
                <i class="fas fa-download"></i> Download PDF Report
            </a>
        </div>
    </div>

    <!-- Charts -->
    <!--<div class="row g-4 mb-4">-->
    <!--    <div class="col-lg-8">-->
    <!--        <div class="chart-container">-->
    <!--            <h5 class="mb-3">User Growth</h5>-->
    <!--            <canvas id="userGrowthChart"></canvas>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="col-lg-4">-->
    <!--        <div class="chart-container">-->
    <!--            <h5 class="mb-3">User Types</h5>-->
    <!--            <canvas id="userTypeChart"></canvas>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
</div>

<!-- Scripts -->
<script>
    // Notification logic
    document.addEventListener('DOMContentLoaded', () => {
        const bell = document.getElementById('notificationBell');
        const dropdown = document.getElementById('notificationDropdown');
        const badge = document.getElementById('notifBadge');

        bell?.addEventListener('click', (event) => {
            event.stopPropagation();
            dropdown.classList.toggle('show');
            if (badge && dropdown.classList.contains('show')) {
                badge.style.display = 'none';
            }
        });

        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target) && !bell.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });

        document.getElementById('markAllRead')?.addEventListener('click', (e) => {
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

    // Chart.js - User Growth Chart
    // const userGrowthChart = new Chart(document.getElementById('userGrowthChart'), {
    //     type: 'line',
    //     data: {
    //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    //         datasets: [
    //             {
    //                 label: 'Total Users',
    //                 data: [120, 190, 170, 220, 260, 300, 350],
    //                 borderColor: '#4F46E5',
    //                 backgroundColor: 'rgba(79, 70, 229, 0.1)',
    //                 tension: 0.3,
    //                 fill: true
    //             },
    //             {
    //                 label: 'New Users',
    //                 data: [30, 40, 50, 60, 70, 80, 90],
    //                 borderColor: '#10B981',
    //                 backgroundColor: 'rgba(16, 185, 129, 0.1)',
    //                 tension: 0.3,
    //                 fill: true
    //             }
    //         ]
    //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: { position: 'top' }
    //         },
    //         scales: { y: { beginAtZero: true } }
    //     }
    // });

    // // Chart.js - User Types Chart (Doughnut)
    // const userTypeChart = new Chart(document.getElementById('userTypeChart'), {
    //     type: 'doughnut',
    //     data: {
    //         labels: ['Customers', 'Mechanics', 'Admins'],
    //         datasets: [{
    //             data: [65, 25, 10],
    //             backgroundColor: ['#4F46E5', '#10B981', '#F59E0B'],
    //             borderWidth: 0
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: { position: 'bottom' }
    //         },
    //         cutout: '70%'
    //     }
    // });
</script>

</body>
</html>
