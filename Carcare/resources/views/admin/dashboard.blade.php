<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .container{
            margin-top:2%;
            
        }
        
        
    </style>
</head>
<body>
        

    <div class="navbar">      
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Home') }}
                     </x-nav-link>
                    <x-nav-link :href="route('adminbooking')" :active="request()->routeIs('adminbooking')">
                        {{ __('Booking') }}
                    </x-nav-link>
                    <x-nav-link :href="route('adminreport')" :active="request()->routeIs('adminreport')">
                        {{ __('Report') }}
                    </x-nav-link>
                    
    
                </div> 
            <div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                           

                            <form method="POST" action="{{ route('admin.logout') }}">
                    <x-responsive-nav-link :href="route('admin.logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                    @csrf

                    
                </form>
                </div>
    </div>
                                         
    </div>
    <div class="navbars">
            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('User Accounts') }}
                    </h3>
        <div class="search">
            <input type="text" placeholder="Search..">
        </div>
         
    </div>
    <div class="container">
        <table class="table table-bordered" style="margin-left:15%">
            <thead>
                <tr>
                    <th>ID<th></th></th>
                    <th>Name <th></th></th>
                    <th>ContactNo <th></th></th>
                    <th>Address <th></th></th>
                    <th>Email <th></th></th>
                    <th>Created At <th></th></th>
                    <th>Updated At <th></th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }} 

                        <td></td></td>

                        <td>{{ $user->name }} <td></td></td>
                        <td>{{ $user->ContactNo }} <td></td></td>
                        <td>{{ $user->Address }} <td></td></td>
                        <td>{{ $user->email }} <td></td></td>
                        <td>{{ $user->created_at }} <td></td></td>
                        <td>{{ $user->updated_at }} <td></td></td>
                        <td>
                        <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        </td>
                        
                    </tr>
                @endforeach

                @foreach ($mechanics as $mechanic)
                    <tr>
                        <td>{{ $mechanic->id }} 

                        <td></td></td>

                        <td>{{ $mechanic->name }} <td></td></td>
                        <td>{{ $mechanic->ContactNo }} <td></td></td>
                        <td>{{ $mechanic->Address }} <td></td></td>
                        <td>{{ $mechanic->email }} <td></td></td>
                        <td>{{ $mechanic->created_at }} <td></td></td>
                        <td>{{ $mechanic->updated_at }} <td></td></td>
                        <td>
                        <form action="{{ route('mechanic.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        </td>
                        
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</body>
</html>
