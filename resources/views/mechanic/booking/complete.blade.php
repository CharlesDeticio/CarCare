<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Orders</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

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

        .completed-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .completed-table th,
        .completed-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .completed-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .completed-table td {
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

        .empty-completed {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
            padding: 20px;
        }

        .home-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 1rem;
            color: #3498db;
            text-decoration: none;
        }

        .home-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <x-sidebar />

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="container">
        @if(count($allCompletedOrders) > 0)
            <table class="completed-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($allCompletedOrders) && count($allCompletedOrders) > 0)
                        @foreach($allCompletedOrders as $userId => $orders)
                            @foreach($orders as $productId => $product)
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <img src="{{ asset('images/products/' . $product['image']) }}" alt="{{ $product['ProductName'] }}">
                                            <h5>{{ $product['ProductName'] }}</h5>
                                        </div>
                                    </td>
                                    <td>₱{{ number_format($product['Price'], 2) }}</td>
                                    <td>{{ $product['status'] }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="empty-completed">No completed orders found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @else
            <p class="empty-completed">No completed orders found.</p>
        @endif
        <a href="{{ route('mechanic.dashboard') }}" class="home-link">Back to Home</a>
    </div>
</body>

</html>