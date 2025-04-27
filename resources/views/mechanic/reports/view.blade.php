<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Details - {{ $report->created_at->format('M d, Y') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-hover: #4338CA;
            --secondary-color: #6B7280;
            --secondary-hover: #4B5563;
            --success-color: #10B981;
            --success-hover: #059669;
            --warning-color: #F59E0B;
            --warning-hover: #D97706;
            --danger-color: #EF4444;
            --danger-hover: #DC2626;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --card-hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: #1f2937;
            line-height: 1.6;
        }

        .container {
            margin-top: 30px;
            margin-bottom: 40px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        h1 {
            font-weight: 600;
            font-size: 28px;
            color: #111827;
            margin-bottom: 0;
        }

        .card {
            border-radius: 10px;
            border: none;
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--card-hover-shadow);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            border-radius: 10px 10px 0 0 !important;
        }

        .card-header h5 {
            font-weight: 600;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .badge {
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
        }

        .badge.bg-primary {
            background-color: var(--primary-color) !important;
        }

        .badge.bg-warning {
            background-color: var(--warning-color) !important;
            color: #1f2937 !important;
        }

        .badge.bg-success {
            background-color: var(--success-color) !important;
        }

        .data-mismatch {
            background-color: #fff3cd;
            border-left: 4px solid var(--warning-color);
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .reference-id {
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
            color: var(--primary-color);
            font-weight: 500;
        }

        .amount {
            font-weight: 600;
            color: var(--primary-color);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 500;
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-top: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .table-warning {
            background-color: rgba(245, 158, 11, 0.05);
        }

        .no-data {
            padding: 30px;
            text-align: center;
            color: #64748b;
            background-color: #f8fafc;
            border-radius: 8px;
        }

        .no-data i {
            font-size: 24px;
            margin-bottom: 10px;
            color: #94a3b8;
        }

        .btn-back {
            background-color: white;
            color: var(--secondary-color);
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background-color: #f8fafc;
            color: var(--secondary-hover);
            border-color: #cbd5e1;
        }

        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .stat-card .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            font-size: 14px;
            color: #64748b;
        }

        .summary-section {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .summary-section {
                grid-template-columns: 1fr 1fr;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .card-header h5 {
                font-size: 18px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .summary-section {
                grid-template-columns: 1fr;
            }
            
            .table-responsive {
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                overflow: hidden;
            }
            
            .table thead {
                display: none;
            }
            
            .table tbody tr {
                display: block;
                margin-bottom: 15px;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }
            
            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 15px;
                border-top: 1px solid #f1f5f9;
            }
            
            .table tbody td::before {
                content: attr(data-label);
                font-weight: 500;
                color: #64748b;
                margin-right: 15px;
                font-size: 13px;
            }
            
            .table tbody tr:last-child {
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @php
            $shopInitials = strtoupper(substr($report->mechanic->shopname ?? 'CAR', 0, 3));
            $datePart = $report->created_at->format('Ymd');
            $randomPart = substr(md5($report->id), 0, 6);
            $reportReference = $shopInitials . '-' . $datePart . '-' . $randomPart;
        @endphp
        
        <div class="header-section">
            <div>
                <h1><i class="fas fa-file-alt"></i> Report Details</h1>
                <p class="text-muted mb-0">Generated on {{ $report->created_at->format('M d, Y - h:i A') }}</p>
            </div>
            <a href="{{ route('mechanic.reports.history') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Back to History
            </a>
        </div>
        
        <!-- Report Summary -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Report Summary</h5>
            </div>
            <div class="card-body">
                @if($orders->count() != $report->total_orders || $bookings->count() != $report->total_users_booked)
                <div class="data-mismatch">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <div>
                        <strong>Data Mismatch Notice</strong>
                        <p class="mb-0">Some data has changed since this report was generated. Numbers shown reflect current data.</p>
                    </div>
                </div>
                @endif
                
                <div class="summary-section">
                    <div class="stat-card">
                        <div class="stat-value">{{ $bookings->count() }}</div>
                        <div class="stat-label">Completed Bookings</div>
                        <small class="text-muted">Reported: {{ $report->total_users_booked }}</small>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">{{ $orders->count() }}</div>
                        <div class="stat-label">Completed Orders</div>
                        <small class="text-muted">Reported: {{ $report->total_orders }}</small>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">{{ $report->remaining_inventory }}</div>
                        <div class="stat-label">Remaining Inventory</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">{{ $report->total_services }}</div>
                        <div class="stat-label">Total Services</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">₱{{ number_format($report->total_revenue, 2) }}</div>
                        <div class="stat-label">Total Revenue</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">{{ $totalProductsCreated }}</div>
                        <div class="stat-label">Products Created</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">{{ $totalServicesCreated }}</div>
                        <div class="stat-label">Services Created</div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><strong>Report ID:</strong> <span class="reference-id">{{ $reportReference }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Report Period:</strong> 
                            {{ ($report->start_date ?? $report->created_at->startOfDay())->format('M d, Y') }}
                            to
                            {{ ($report->end_date ?? $report->created_at->endOfDay())->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Orders Section -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-0">
                    <i class="fas fa-shopping-cart"></i> Completed Orders ({{ $orders->count() }})
                    @if($newCompletedOrders > 0)
                        <span class="badge bg-warning ms-2">+{{ $newCompletedOrders }} New</span>
                    @endif
                </h5>
                <span class="badge bg-primary">{{ $orders->count() }} found</span>
            </div>
            <div class="card-body">
                @if($orders->isEmpty())
                    <div class="no-data">
                        <i class="far fa-folder-open"></i>
                        <p>No completed orders found for this report period</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @php
                                        $shopInitials = strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3));
                                        $datePart = $order->created_at->format('Ymd');
                                        $randomPart = substr(md5($order->id), 0, 6);
                                        $orderReference = $shopInitials . $datePart . $randomPart;
                                    @endphp
                                    <tr @if($order->is_new) class="table-warning" @endif>
                                        <td data-label="Order ID" class="reference-id">
                                            {{ $orderReference }}
                                            @if($order->is_new)
                                                <span class="badge bg-warning ms-1">New</span>
                                            @endif
                                        </td>
                                        <td data-label="Customer">{{ $order->user->first_name ?? 'N/A' }} {{ $order->user->last_name ?? '' }}</td>
                                        <td data-label="Product">
                                            @foreach($order->items as $item)
                                                @if($item->product && $item->product->mechanic_id === auth('mechanic')->id())
                                                    {{ $item->product->ProductName }}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td data-label="Qty">
                                            @foreach($order->items as $item)
                                                @if($item->product && $item->product->mechanic_id === auth('mechanic')->id())
                                                    {{ $item->quantity }}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td data-label="Date">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td data-label="Amount" class="amount">₱{{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Completed Bookings Section -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-check"></i> Completed Bookings ({{ $bookings->count() }})
                    @if($newCompletedBookings > 0)
                        <span class="badge bg-warning">+{{ $newCompletedBookings }} New</span>
                    @endif
                </h5>
                <span class="badge bg-primary">{{ $bookings->count() }} found</span>
            </div>
            <div class="card-body">
                @if($bookings->isEmpty())
                    <div class="no-data">
                        <i class="far fa-calendar-times"></i>
                        <p>No completed bookings found for this report period</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    @php
                                        $shopInitials = strtoupper(substr($booking->mechanic->shopname ?? 'CAR', 0, 3));
                                        $datePart = $booking->created_at->format('Ymd');
                                        $randomPart = substr(md5($booking->id), 0, 6);
                                        $bookingReference = $shopInitials . $datePart . $randomPart;
                                    @endphp
                                    <tr @if($booking->is_new) class="table-warning" @endif>
                                        <td data-label="Booking ID" class="reference-id">
                                            {{ $bookingReference }}
                                            @if($booking->is_new)
                                                <span class="badge bg-warning ms-1">New</span>
                                            @endif
                                        </td>
                                        <td data-label="Customer">{{ $booking->user->first_name ?? 'N/A' }} {{ $booking->user->last_name ?? '' }}</td>
                                        <td data-label="Service">{{ $booking->service->name ?? 'N/A' }}</td>
                                        <td data-label="Date">{{ $booking->booking_date }}</td>
                                        <td data-label="Time">{{ $booking->booking_time }}</td>
                                        <td data-label="Amount" class="amount">₱{{ number_format($booking->service->price ?? 0, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Products Created Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-box-open"></i> Products ({{ $totalProductsCreated }})</h5>
            </div>
            <div class="card-body">
                @php
                    $reportDate = $report->created_at;
                    $products = \App\Models\Product::where('mechanic_id', $report->mechanic_id)->get();
                @endphp
                @if($products->isEmpty())
                    <div class="no-data">
                        <i class="fas fa-boxes"></i>
                        <p>No products created by this mechanic</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    @php
                                        $shopInitials = strtoupper(substr($product->mechanic->shopname ?? 'CAR', 0, 3));
                                        $datePart = $product->created_at->format('Ymd');
                                        $randomPart = substr(md5($product->id), 0, 6);
                                        $productReference = $shopInitials . '-' . $datePart . '-' . $randomPart;
                                    @endphp
                                    <tr @if($product->created_at > $reportDate) class="table-warning" @endif>
                                        <td data-label="Product Name">{{ $product->ProductName }}
                                            @if($product->created_at > $reportDate)
                                                <span class="badge bg-warning ms-1">New</span>
                                            @endif
                                        </td>
                                        <td data-label="Category">{{ $product->category }}</td>
                                        <td data-label="Price">₱{{ number_format($product->Price, 2) }}</td>
                                        <td data-label="Stock">{{ $product->Inventory }}</td>
                                        <td data-label="Created">{{ $product->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Services Created Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tools"></i> Services ({{ $totalServicesCreated }})</h5>
            </div>
            <div class="card-body">
                @php
                    $services = \App\Models\Service::where('mechanic_id', $report->mechanic_id)->get();
                @endphp
                @if($services->isEmpty())
                    <div class="no-data">
                        <i class="fas fa-concierge-bell"></i>
                        <p>No services created by this mechanic</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Price</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    @php
                                        $shopInitials = strtoupper(substr($service->mechanic->shopname ?? 'CAR', 0, 3));
                                        $datePart = $service->created_at->format('Ymd');
                                        $randomPart = substr(md5($service->id), 0, 6);
                                        $serviceReference = $shopInitials . '-' . $datePart . '-' . $randomPart;
                                    @endphp
                                    <tr @if($service->created_at > $reportDate) class="table-warning" @endif>
                                        <td data-label="Service Name">{{ $service->name }}
                                            @if($service->created_at > $reportDate)
                                                <span class="badge bg-warning ms-1">New</span>
                                            @endif
                                        </td>
                                        <td data-label="Price">₱{{ number_format($service->price, 2) }}</td>
                                        <td data-label="Created">{{ $service->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Responsive table adjustments
            function setupResponsiveTable() {
                const cells = document.querySelectorAll('td');
                const headers = document.querySelectorAll('th');
                
                if (window.innerWidth < 576) {
                    headers.forEach((header, index) => {
                        const label = header.textContent;
                        document.querySelectorAll('td:nth-child(' + (index + 1) + ')').forEach(cell => {
                            cell.setAttribute('data-label', label);
                        });
                    });
                }
            }
            
            // Run on load and resize
            setupResponsiveTable();
            window.addEventListener('resize', setupResponsiveTable);
        });
    </script>
</body>
</html>