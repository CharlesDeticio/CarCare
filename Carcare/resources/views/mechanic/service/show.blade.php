<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details</title>
</head>
<body>
    <h1>Service Details</h1>
    <p><strong>Name:</strong> {{ $service->name }}</p>
    <p><strong>Description:</strong> {{ $service->description }}</p>
    <p><strong>Price:</strong> {{ $service->price }}</p>

    <a href="{{ route('mechanic.dashboard') }}">Back to Dashboard</a>
</body>
</html>
