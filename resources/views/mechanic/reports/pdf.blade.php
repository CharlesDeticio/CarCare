<!DOCTYPE html>
<html>
<head>
    <title>Mechanic Shop Reports PDF - Carcare</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .section-header { margin: 30px 0 10px; font-size: 16px; font-weight: bold; border-bottom: 2px solid #333; padding-bottom: 5px; }
        .logo { width: 150px; margin-bottom: 10px; }
        .summary-table { width: 100%; margin-bottom: 30px; }
        .summary-table th { background-color: #333; color: #fff; text-align: center; }
        .summary-table td { text-align: center; }
        .totals-section { margin-top: 40px; }
        .totals-section h3 { font-size: 14px; font-weight: bold; margin-bottom: 10px; }
        .totals-section table { width: 50%; }
        .header-container { text-align: center; margin-bottom: 20px; }
        .shop-name { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
        .shop-address { font-size: 14px; color: #666; }
    </style>
</head>
<body>
<!-- UC Logo and University Name Section -->
<div style="text-align: center; margin-bottom: 20px;">
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/UC.png'))) }}" class="logo" alt="UC Logo">
    <div style="font-size: 14px; font-weight: bold; color: black;">
        University of Cebu Lapu-Lapu and Mandaue
    </div>
</div>
    <!-- Logo and Shop Info Section -->
    <div class="header-container">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/carcare.png'))) }}" class="logo" alt="Carcare Logo">
        <div class="shop-name"  style="margin-top: 20px">{{ $mechanic->shopname ?? 'CarCare Shop' }}</div>
        <div class="shop-address">{{ $mechanic->Address ?? '123 Main Street, City, Country' }}</div>
    </div>

    <p style="text-align: center;"><strong>Generated on:</strong> {{ now()->toDayDateTimeString() }}</p>

    <!-- Summary Report -->
    <div class="section-header">Reports Summary</div>
    <table class="summary-table">
        <thead>
            <tr>
                <th>Total Booked</th>
                <th>Total Orders</th>
                <th>Total Product Inventory</th>
                <th>Total Services</th>
                <th>Total Order Sales (PHP)</th>
                <th>Total Bookings Sales (PHP)</th>
                <th>Grand Total Sales (PHP)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $totalUsersWhoBooked }}</td>
                <td>{{ $totalOrders }}</td>
                <td>{{ $totalProductInventory }}</td>
                <td>{{ $totalServices }}</td>
                <td>{{ number_format($totalOrderPrice, 2) }}</td>
                <td>{{ number_format($totalBookingsPrice, 2) }}</td>
                <td>{{ number_format($totalSales, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Products Report -->
    <div class="section-header">Products Report</div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price (PHP)</th>
                <th>Inventory</th>
            </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->ProductName }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ number_format($product->Price, 2) }}</td>
                <td>{{ $product->Inventory }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center;">No products found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Services Report -->
    <div class="section-header">Services Report</div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price (PHP)</th>
            </tr>
        </thead>
        <tbody>
        @forelse($services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                <td>{{ number_format($service->price, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="text-align: center;">No services found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Completed Orders Report -->
    <div class="section-header">Completed Orders Report</div>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Products Ordered</th>
            <th>Amount (PHP)</th>
            <th>Order Date</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
    @php $ordersTotalAmount = 0; @endphp
    @forelse($orders as $order)
        @php 
            $ordersTotalAmount += $order->total_amount;
            // Generate alphanumeric order reference
            $shopInitials = strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3));
            $datePart = $order->created_at->format('Ymd');
            $randomPart = substr(md5($order->id), 0, 6);
            $orderReference = $shopInitials  . $datePart  . $randomPart;
        @endphp
        <tr>
            <td>{{ $orderReference }}</td>
            <td>{{ $order->user->first_name ?? 'Guest' }} {{ $order->user->last_name ?? 'Guest' }}</td>
            <td>
                @forelse($order->items as $item)
                    {{ $item->product->ProductName ?? 'N/A' }} (Qty: {{ $item->quantity }})<br>
                @empty
                    No products found.
                @endforelse
            </td>
            <td>{{ number_format($order->total_amount, 2) }}</td>
            <td>{{ $order->created_at->format('M d, Y') }}</td>
            <td>{{ $order->created_at->format('h:i A') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6" style="text-align: center;">No completed orders found.</td>
        </tr>
    @endforelse
    </tbody>
</table>

<!-- Completed Bookings Report -->
<div class="section-header">Completed Bookings Report</div>
<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Customer</th>
            <th>Service</th>
            <th>Price (PHP)</th>
            <th>Booking Date</th>
            <th>Booking Time</th>
            <th>Date of Booking</th>
            <th>Time of Booking</th>
        </tr>
    </thead>
    <tbody>
    @forelse($bookings as $booking)
        @php
            // Generate alphanumeric booking reference
            $shopInitials = strtoupper(substr($booking->mechanic->shopname ?? 'CAR', 0, 3));
            $datePart = $booking->created_at->format('Ymd');
            $randomPart = substr(md5($booking->id), 0, 6);
            $bookingReference = $shopInitials  . $datePart  . $randomPart;
        @endphp
        <tr>
            <td>{{ $bookingReference }}</td>
            <td>{{ $booking->user->first_name ?? 'N/A' }} {{ $booking->user->last_name ?? '' }}</td>
            <td>{{ $booking->service->name ?? 'N/A' }}</td>
            <td>{{ number_format($booking->service->price ?? 0, 2) }}</td>
            <td>{{ $booking->booking_date }}</td>
            <td>{{ $booking->booking_time }}</td>
            <td>{{ $booking->created_at->format('M d, Y') }}</td>
            <td>{{ $booking->created_at->format('h:i A') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="8" style="text-align: center;">No completed bookings found.</td>
        </tr>
    @endforelse
    </tbody>
</table>

    <!-- Sales Summary Section -->
    <div class="totals-section">
        <h3>Sales Summary</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount (PHP)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Orders Sales</td>
                    <td>{{ number_format($totalOrderPrice, 2) }}</td>
                </tr>
                <tr>
                    <td>Total Bookings Sales</td>
                    <td>{{ number_format($totalBookingsPrice, 2) }}</td>
                </tr>
                @if(isset($orderItemsTotal))
                <tr>
                    <td>Order Items Sales (from products)</td>
                    <td>{{ number_format($orderItemsTotal, 2) }}</td>
                </tr>
                @endif
                <tr>
                    <td><strong>Grand Total Sales</strong></td>
                    <td><strong>{{ number_format($totalSales, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>