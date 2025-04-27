<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Overview</title>

    <!-- Font Awesome & Boxicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1f2937;
            --bg-light: #f9fafb;
            --bg-dark: #111827;
            --text-light: #6b7280;
            --white: #ffffff;
            --border-color: #e5e7eb;
            --transition: 0.3s ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-light);
            color: var(--secondary-color);
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            transition: var(--transition);
        }

        .sidebar-wrapper {
            width: 240px;
            background-color: var(--secondary-color);
            /* color: var(--white); */
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: var(--transition);
            z-index: 1000;
        }

        .sidebar-wrapper.open {
            left: 0;
        }

        .main-content {
            margin-left: 240px;
            padding: 30px 40px;
            flex-grow: 1;
            transition: var(--transition);
            min-width: 0;
            margin-top: 60px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        header .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--secondary-color);
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
        }

        .overview-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background-color: var(--white);
            flex: 1 1 200px;
            min-width: 200px;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            text-align: center;
            border: 1px solid var(--border-color);
            position: relative;
        }

        .card:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .card i {
            font-size: 36px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 10px;
        }

        .card p {
            font-size: 26px;
            font-weight: 700;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            color: var(--white);
            background-color: var(--primary-color);
            border: none;
            transition: var(--transition);
        }

        .btn i {
            font-size: 16px;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }

        .table-section {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
            overflow-x: auto;
            padding: 20px;
            border: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .section-subtitle {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        thead {
            background-color: var(--bg-light);
        }

        th, td {
            padding: 14px 16px;
            font-size: 14px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            color: var(--text-light);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
        }

        tbody tr:hover {
            background-color: #f3f4f6;
            cursor: pointer;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            font-size: 12px;
            border-radius: 9999px;
            font-weight: 500;
        }

        .badge-pending { background-color: #fde68a; color: #92400e; }
        .badge-accepted, .badge-in_transit { background-color: #6ee7b7; color: #065f46; }
        .badge-completed { background-color: #93c5fd; color: #1e40af; }
        .badge-declined { background-color: #fca5a5; color: #7f1d1d; }

        .alert {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        /* RESPONSIVENESS */
        @media (max-width: 1024px) {
            header .menu-toggle { display: block; }
            .sidebar-wrapper { left: -240px; position: fixed; }
            .sidebar-wrapper.open { left: 0; }
            .main-content { margin-left: 0; padding: 20px; }
        }

        @media (max-width: 768px) {
            .overview-cards { flex-direction: column; }
            table { min-width: 100%; }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }
        .custom-pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.custom-pagination a,
.custom-pagination span {
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
    color: #333;
    background-color: #f0f0f0;
    transition: background-color 0.3s, color 0.3s;
}

.custom-pagination a:hover {
    background-color: #007bff;
    color: #fff;
}

.custom-pagination .active {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

.custom-pagination .disabled {
    color: #ccc;
    cursor: default;
    background-color: #e9e9e9;
}

    </style>
</head>

<body>

    <!-- FLASH MESSAGE -->
    @if (session('status'))
    <div class="alert fade-in">
        {{ session('status') }}
    </div>
    @endif

    <!-- Sidebar -->
    <div class="sidebar-wrapper fade-in" id="sidebar">
        <x-sidebar />
    </div>

    <!-- Main Content -->
    <div class="main-content fade-in">
        <header>
            <h1>Dashboard Overview</h1>
            <i class='bx bx-menu menu-toggle' id="menuToggle"></i>
        </header>

        <!-- Overview Cards -->
        <div class="overview-cards">
            <div class="card">
                <i class='bx bx-calendar'></i>
                <h3>Total Bookings</h3>
                <p>{{ $totalBookings }}</p>
            </div>
            <div class="card">
                <i class='bx bx-cart'></i>
                <h3>Total Orders</h3>
                <p>{{ $totalOrders }}</p>
            </div>
            <div class="card">
                <i class='bx bx-check-circle'></i>
                <h3>Completed Bookings</h3>
                <p>{{ $completedBookings }}</p>
            </div>
            <div class="card">
                <i class='bx bx-package'></i>
                <h3>Completed Orders</h3>
                <p>{{ $completedOrders }}</p>
            </div>
        </div>

        <!-- Report Button -->
        <!-- Report Buttons -->
<div style="margin-bottom: 40px; display: flex; gap: 12px; flex-wrap: wrap;">
    <a href="{{ route('mechanic.reports.index') }}" class="btn">
        <i class='bx bx-file'></i> View Reports
    </a>

    <!--<a href="{{ route('mechanic.reports.history') }}" class="btn" style="background-color: #6b7280;">-->
    <!--    <i class='bx bx-history'></i> View Report History-->
    <!--</a>-->
</div>


        <!-- Recent Bookings Section -->
<div class="table-section fade-in">
    <h2 class="section-title">Recent Bookings</h2>
    <p class="section-subtitle">Click a booking to view more details.</p>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Customer</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentBookings as $booking)
                <tr class="clickable-row" data-href="{{ route('mechanic.bookings.show', $booking->id) }}">
                    <td>
                        @php
                            $shopInitials = strtoupper(substr($booking->mechanic->shopname ?? 'CAR', 0, 3));
                            $datePart = $booking->created_at->format('Ymd');
                            $randomPart = substr(md5($booking->id), 0, 6);
                            $bookingReference = $shopInitials . $datePart . $randomPart;
                        @endphp
                        {{ $bookingReference }}
                    </td>
                    <td>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
                    <td>{{ $booking->service->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</td>
                    <td>₱{{ $booking->service->price }}</td>
                    <td>
                        <span class="status-badge
                            @if($booking->status === 'pending') badge-pending
                            @elseif($booking->status === 'accepted') badge-accepted
                            @elseif($booking->status === 'completed') badge-completed
                            @elseif($booking->status === 'declined') badge-declined
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-light);">No recent bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination for Bookings --}}
    @if($recentBookings->hasPages())
        <div class="custom-pagination">
            @if ($recentBookings->onFirstPage())
                <span class="disabled">&laquo;</span>
            @else
                <a href="{{ $recentBookings->previousPageUrl() }}">&laquo;</a>
            @endif

            @foreach ($recentBookings->getUrlRange(1, $recentBookings->lastPage()) as $page => $url)
                @if ($page == $recentBookings->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if ($recentBookings->hasMorePages())
                <a href="{{ $recentBookings->nextPageUrl() }}">&raquo;</a>
            @else
                <span class="disabled">&raquo;</span>
            @endif
        </div>
    @endif
</div>

<!-- Recent Orders Section -->
<div class="table-section fade-in">
    <h2 class="section-title">Recent Orders</h2>
    <p class="section-subtitle">Click an order to view more details.</p>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentOrders as $order)
                <tr class="clickable-row" data-href="{{ route('mechanic.orders.show', $order->id) }}">
                    <td>
                        {{ strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3)) }}
                        {{ date('Ymd', strtotime($order->created_at)) }}
                        {{ substr(md5($order->id), 0, 6) }}
                    </td>
                    <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                    <td>
                        @if($order->items->count() === 1)
                            {{ $order->items->first()->product->ProductName }}
                        @elseif($order->items->count() > 1)
                            Multiple Items
                        @else
                            No Product
                        @endif
                    </td>
                    <td>₱{{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="status-badge
                            @if($order->status === 'pending') badge-pending
                            @elseif($order->status === 'in_transit') badge-accepted
                            @elseif($order->status === 'completed') badge-completed
                            @elseif($order->status === 'declined') badge-declined
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-light);">No recent orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination for Orders --}}
    @if($recentOrders->hasPages())
        <div class="custom-pagination">
            @if ($recentOrders->onFirstPage())
                <span class="disabled">&laquo;</span>
            @else
                <a href="{{ $recentOrders->previousPageUrl() }}">&laquo;</a>
            @endif

            @foreach ($recentOrders->getUrlRange(1, $recentOrders->lastPage()) as $page => $url)
                @if ($page == $recentOrders->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if ($recentOrders->hasMorePages())
                <a href="{{ $recentOrders->nextPageUrl() }}">&raquo;</a>
            @else
                <span class="disabled">&raquo;</span>
            @endif
        </div>
    @endif
</div>

    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const rows = document.querySelectorAll(".clickable-row");
            rows.forEach(row => {
                row.addEventListener("click", () => {
                    window.location.href = row.dataset.href;
                });
            });

            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        });
    </script>

    <script src="{{ asset('assets/js/script2.js') }}"></script>

</body>

</html>
