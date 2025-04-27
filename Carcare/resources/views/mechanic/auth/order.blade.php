<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product & Order Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f7fc;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background-color: #4CAF50;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            left: 0;
            top: 0;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #45a049;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        /* Main content area */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            width: 100%;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-details p {
            font-size: 16px;
            margin: 10px 0;
        }

        .product-details strong {
            color: #4CAF50;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .order-management {
            margin-top: 30px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-table th, .order-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .order-table th {
            background-color: #4CAF50;
            color: white;
        }

        .order-status {
            padding: 5px 10px;
            border-radius: 4px;
            text-transform: capitalize;
        }

        .pending { background-color: #f8d7da; color: #721c24; }
        .completed { background-color: #d4edda; color: #155724; }
        .processing { background-color: #fff3cd; color: #856404; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Shop Dashboard</h2>
        <a href="#">Dashboard</a>
        <a href="#">Products</a>
        <a href="#">Orders</a>
        <a href="#">Customers</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Product & Order Management</h1>

        <div class="container">
            <!-- Product Details -->
            <div class="product-details">
                <p><strong>Product Name:</strong> Example Product</p>
                <p><strong>Description:</strong> This is an example description of the product.</p>
                <p><strong>Price:</strong> $100.00</p>
                <p><strong>Inventory:</strong> 50</p>

                <!-- Action Buttons -->
                <a href="#" class="btn">Add to Cart</a>
                <a href="#" class="btn">View Orders</a>
            </div>

            <!-- Order Management -->
            <div class="order-management">
                <h2>Order Management</h2>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>John Doe</td>
                            <td><span class="order-status pending">Pending</span></td>
                            <td><a href="#" class="btn">Mark as Completed</a></td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>Jane Smith</td>
                            <td><span class="order-status completed">Completed</span></td>
                            <td><a href="#" class="btn">Mark as Pending</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
