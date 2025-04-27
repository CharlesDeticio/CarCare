<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background-color: #fff;
            border-bottom: 1px solid #ddd;

        }

        .navbars {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;

        }
        .navbar a {
            margin: 0 1rem;
            text-decoration: none;
            color: #000;
        }
        .navbar .user {
            display: flex;
            align-items: center;
        }
        .navbar .user span {
            margin-left: 0.5rem;
        }
        .dashboard {
            padding: 2rem;
        }
        .dashboard h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .logout {
            padding: 1rem;
            background-color: #fff;
            border: 1px solid #ddd;
            text-align: center;
            margin-top: 2rem;
            border-radius: 5px;
            width: 150px;
        }
        .navbars h3 {
            margin-left:15px;
        }
        .navbar .search .text {
            margin-right: -20%
        }
        
    </style>
</head>
<body>
        

    <div class="navbar">      
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('mechanic.dashboard')" :active="request()->routeIs('mechanic.dashboard')">
                        {{ __('Home') }}
                     </x-nav-link>
                    <x-nav-link :href="route('order')" :active="request()->routeIs('order')">
                        {{ __('Order') }}
                    </x-nav-link>
                    <x-nav-link :href="route('report')" :active="request()->routeIs('report')">
                        {{ __('Report') }}
                    </x-nav-link>
                    
    
                </div> 
            <div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <div>(Mechanic) {{ Auth::user()->name }}</div>

                            <form method="POST" action="{{ route('mechanic.logout') }}">
                    <x-responsive-nav-link :href="route('mechanic.logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                    @csrf

                    
                </form>
                </div>
    </div>
                                         
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Welcome!') }}
                            </h3>
                            <div class="search">
                                <input type="text" placeholder="Search..">
                            </div>
                </div>
        </div>
    </div>
    <div class="container">
    <h2>Edit Product</h2>
    <a href="{{ route('mechanic.products.create') }}" class="btn btn-primary">Add New Product</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('mechanic.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ProductName">Product Name:</label>
            <input type="text" class="form-control" id="ProductName" name="ProductName" value="{{ $product->ProductName }}" required>
        </div>
        <div class="form-group">
            <label for="Description">Description:</label>
            <textarea class="form-control" id="Description" name="Description">{{ $product->Description }}</textarea>
        </div>
        <div class="form-group">
            <label for="Price">Price:</label>
            <input type="number" class="form-control" id="Price" name="Price" value="{{ $product->Price }}" required>
        </div>
        <div class="form-group">
            <label for="Inventory">Inventory:</label>
            <input type="number" class="form-control" id="Inventory" name="Inventory" value="{{ $product->Inventory }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
</body>
</html>
