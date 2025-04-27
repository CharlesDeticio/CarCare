<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 800px;
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF;
        }
        .service-details {
            margin-top: 20px;
        }
        .service-details p {
            margin: 10px 0;
        }
        .btn {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Service Details</h1>
        <div class="service-details">
            <p><strong>Name:</strong> {{ $service->name }}</p>
            <p><strong>Description:</strong> {{ $service->description }}</p>
            <p><strong>Price:</strong> ${{ number_format($service->price, 2) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($service->status) }}</p>
        </div>

        <!-- Book Now Button -->
            <a href="{{ route('user.bookings.create', $service->id) }}" class="btn">Submit</a>
  
    </div>
</body>
</html>