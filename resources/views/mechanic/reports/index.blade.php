<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carcare Analytics Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Chart.js -->
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
        
        .dashboard-header {
            background-color: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }
        
        .dashboard-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .dashboard-subtitle {
            color: var(--gray-color);
            font-size: 1rem;
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
            font-size: 2rem;
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
        
        /* Added for smaller chart */
        .chart-container canvas {
            max-height: 250px;
            width: 100% !important;
        }
        
        .btn-action {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-action:hover {
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-overview {
            background-color: var(--secondary-color);
        }
        
        .btn-history {
            background-color: var(--warning-color);
        }
        
        .btn-download {
            background-color: var(--primary-dark);
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .report-section {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }
        
        .section-header {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #EEE;
        }
        
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table {
            font-size: 0.875rem;
        }
        
        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(79, 70, 229, 0.05);
        }
        
        .summary-table {
            max-width: 500px;
        }
        
        .summary-table td:last-child {
            font-weight: 600;
        }
        
        .summary-table tr:last-child td {
            font-weight: 700;
            color: var(--primary-dark);
        }
        
        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.75rem;
            }
            
            .dashboard-title {
                font-size: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <div class="container py-4">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Carcare Analytics Dashboard</h1>
            <p class="dashboard-subtitle">Comprehensive overview of sales and service performance</p>
            
            <div class="action-buttons mt-3">
                <a href="{{ route('mechanic.overview') }}" class="btn-action btn-overview">
                    <i class="fas fa-chart-line"></i> Overview
                </a>
                <!--<a href="{{ route('mechanic.reports.history') }}" class="btn-action btn-history">-->
                <!--    <i class="fas fa-history"></i> Report History-->
                <!--</a>-->
                <a href="{{ route('mechanic.reports.pdf') }}" class="btn-action btn-download">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
            </div>
        </div>
        
        <!-- Stats Cards Row -->
        <div class="row g-4 mb-4">
            <!-- Total Sales -->
            <div class="col-md-6 col-lg-4">
                <div class="stat-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="stat-title">Grand Total Sales</h6>
                                <h2 class="stat-value">₱{{ number_format($totalSales, 2) }}</h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="fas fa-money-bill-wave text-primary"></i>
                            </div>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up me-1"></i> Combined from all sources
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Sales -->
            <div class="col-md-6 col-lg-4">
                <div class="stat-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="stat-title">Order Sales</h6>
                                <h2 class="stat-value">₱{{ number_format($totalOrderPrice, 2) }}</h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="fas fa-shopping-cart text-success"></i>
                            </div>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up me-1"></i> {{ $orders->where('status', 'completed')->count() }} completed orders
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking Sales -->
            <div class="col-md-6 col-lg-4">
                <div class="stat-card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="stat-title">Booking Sales</h6>
                                <h2 class="stat-value">₱{{ number_format($totalBookingsPrice, 2) }}</h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="fas fa-calendar-check text-warning"></i>
                            </div>
                        </div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up me-1"></i> {{ $bookings->where('status', 'completed')->count() }} completed bookings
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sales Breakdown Chart (now smaller) -->
        <div class="chart-container">
            <h5 class="section-header">Sales Breakdown</h5>
            <canvas id="salesChart" height="250"></canvas>
        </div>
        
        <!-- Products Report -->
        <div class="report-section">
            <h5 class="section-header">Products Inventory</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <!--<td>{{ $product->id }}</td>-->
                                <td>{{ $product->ProductName }}</td>
                                <td>{{ $product->category }}</td>
                                <td>₱{{ number_format($product->Price, 2) }}</td>
                                <td>
                                    <span class="{{ $product->Inventory > 10 ? 'text-success' : ($product->Inventory > 0 ? 'text-warning' : 'text-danger') }}">
                                        {{ $product->Inventory }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">No products found in inventory</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Services Report -->
        <div class="report-section">
            <h5 class="section-header">Services Offered</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Service Name</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <!--<td>{{ $service->id }}</td>-->
                                <td>{{ $service->name }}</td>
                                <td>₱{{ number_format($service->price, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">No services available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Completed Orders Report -->
        <div class="report-section">
            <h5 class="section-header">Completed Orders</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Products</th>
                            <th>Amount</th>
                            <th>Date/Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders->where('status', 'completed') as $order)
                            @php
                                $shopInitials = strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3));
                                $datePart = $order->created_at->format('Ymd');
                                $randomPart = substr(md5($order->id), 0, 6);
                                $orderReference = $shopInitials  . $datePart  . $randomPart;
                            @endphp
                            <tr>
                                <td>{{ $orderReference }}</td>
                                <td>{{ $order->user->first_name ?? 'Guest' }} {{ $order->user->last_name ?? '' }}</td>
                                <td>
                                    @foreach($order->items as $item)
                                        • {{ $item->product->ProductName ?? 'N/A' }} (×{{ $item->quantity }})<br>
                                    @endforeach
                                </td>
                                <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    {{ $order->created_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">No completed orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Completed Bookings Report -->
        <div class="report-section">
            <h5 class="section-header">Completed Bookings</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Mechanic</th>
                            <th>Price</th>
                            <th>Scheduled</th>
                            <th>Booked On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings->where('status', 'completed') as $booking)
                            @php
                                $shopInitials = strtoupper(substr($booking->mechanic->shopname ?? 'CAR', 0, 3));
                                $datePart = $booking->created_at->format('Ymd');
                                $randomPart = substr(md5($booking->id), 0, 6);
                                $bookingReference = $shopInitials  . $datePart  . $randomPart;
                            @endphp
                            <tr>
                                <td>{{ $bookingReference }}</td>
                                <td>{{ $booking->user->first_name ?? 'N/A' }} {{ $booking->user->last_name ?? '' }}</td>
                                <td>{{ $booking->service->name ?? 'N/A' }}</td>
                                <td>{{ $booking->mechanic->shopname ?? 'N/A' }}</td>
                                <td>₱{{ number_format($booking->service->price ?? 0, 2) }}</td>
                                <td>
                                    {{ $booking->booking_date }}<br>
                                    <small class="text-muted">{{ $booking->booking_time }}</small>
                                </td>
                                <td>
                                    {{ $booking->created_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $booking->created_at->format('h:i A') }}</small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">No completed bookings found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Sales Summary -->
        <div class="report-section">
            <h5 class="section-header">Sales Summary</h5>
            <div class="table-responsive summary-table">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Total Order Sales</td>
                            <td>₱{{ number_format($totalOrderPrice, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total Booking Sales</td>
                            <td>₱{{ number_format($totalBookingsPrice, 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total Sales</strong></td>
                            <td><strong>₱{{ number_format($totalSales, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sales Breakdown Chart with smaller size configuration
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Product Sales', 'Service Bookings'],
                datasets: [{
                    data: [{{ $totalOrderPrice }}, {{ $totalBookingsPrice }}],
                    backgroundColor: [
                        '#4F46E5',
                        '#10B981'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // This allows the chart to respect our height setting
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ₱' + context.raw.toLocaleString('en-PH', { 
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2 
                                });
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    </script>
</body>
</html>