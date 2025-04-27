<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;            
            background-size: cover;
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .order-summary {
            background-color: #f4f4f4;
            margin: 20px auto;
            padding: 20px;
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .order-summary img {
            width: 50px;
            vertical-align: middle;
        }
        .order-summary div {
            display: inline-block;
            margin: 0 20px;
            vertical-align: middle;
        }
        .cancel-button {
            float: right;
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .cancel-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="order-summary">
    <div>
        <strong>Nelson's Automotive Shop</strong><br>
        Belt
    </div>
    <div>
        <img src="" alt="Belt">
    </div>
    <div>
        <img src="" alt="Order Icon">
        <strong>Total Order: $50</strong>
    </div>
    <button class="cancel-button">Cancel Order</button>
</div>

</body>
</html>
</x-app-layout>
