<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechaic Dashboard</title>
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
            background: transparent;

        }
        .navbars {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            background: transparent;

        }
        .navbar1 {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            margin-top:2%;

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
        h3 {
            margin-left:25px;
        }
        .search-input {
            margin-right: 20px;
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
                
    </div>
                                         
    </div>
    
            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Report') }}
                    
                    </h3>
        
            
        
    
    
    <input type="text" placeholder="Search.." style="margin-left: 24px;">

</body>
</html>
