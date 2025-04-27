<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <title>Mechanic Bookings</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            font-size: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 1rem;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .bookings-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .bookings-table td {
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-info img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            margin-right: 15px;
        }

        .product-info h5 {
            margin: 0;
            font-size: 1rem;
            color: #333;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .btn-accept {
            background-color: #28a745;
            color: #fff;
        }

        .btn-decline {
            background-color: #dc3545;
            color: #fff;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .empty-bookings {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
            padding: 20px;
        }
    </style>
</head>

<body>
    <x-sidebar />

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-error">{{ Session::get('error') }}</div>
    @endif

    <div class="container">
        @if(count($allPendingOrders) > 0)
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allPendingOrders as $userId => $orders)
                        @foreach($orders as $productId => $product)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        @if(isset($product['image']))
                                            <img src="{{ asset('images/products/' . $product['image']) }}" alt="{{ $product['ProductName'] }}">
                                        @else
                                            <img src="{{ asset('images/default-product.png') }}" alt="Default Image">
                                        @endif
                                        <h5>{{ $product['ProductName'] }}</h5>
                                    </div>
                                </td>
                                <td>₱{{ number_format($product['Price'], 2) }}</td>
                                <td>{{ $product['status'] ?? 'pending' }}</td>
                                <td>
                                    <a href="{{ route('mechanic.booking.accept', ['userId' => $userId, 'productId' => $productId]) }}" class="btn btn-accept">Accept</a>
                                    <a href="{{ route('mechanic.booking.decline', ['userId' => $userId, 'productId' => $productId]) }}" class="btn btn-decline">Decline</a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="empty-bookings">No pending orders found.</p>
        @endif
    </div>
</body>

</html>