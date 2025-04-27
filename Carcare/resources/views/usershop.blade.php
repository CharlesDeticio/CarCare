<x-app-layout>
    <x-slot name="header">
    
        </h2>
    </x-slot>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nelson's Automotive</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        header {
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
            padding: 10px;
        }
        header img {
            height: 50px;
            margin-right: 20px;
        }
        nav {
            flex-grow: 1;
        }
        nav a {
            margin-right: 20px;
            text-decoration: none;
            color: #333;
        }
        .search-cart {
            display: flex;
            align-items: center;
        }
        .search-cart input {
            margin-right: 10px;
            padding: 5px;
        }
        .products {
            display: flex;
            justify-content: center;
            margin: 20px;
        }
        .product {
            text-align: center;
            margin: 0 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 10px;
        }
        .product img {
            width: 100px;
            height: auto;
        }
        .product button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <img src="logo.png" alt="Logo">
    <div class="search-cart" style>
        <input type="text" placeholder="Search">
        <img src="cart-icon.png" alt="Cart" width="30">
    </div>
</header>

<div class="products">
    <div class="product">
        <img src="engine-belt.png" alt="Engine Belt">
        <h2>Engine Belt</h2>
        <p>$50</p>
        <button>Buy Now</button>
    </div>
    <div class="product">
        <img src="oil-filter.png" alt="Oil Filter">
        <h2>Oil Filter</h2>
        <p>$150</p>
        <button>Buy Now</button>
    </div>
</div>

</body>
</html>
</x-app-layout>
