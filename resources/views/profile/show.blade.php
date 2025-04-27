<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Carcare</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">

    <!-- Custom CSS (Optional external file) -->
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 900px;
            margin: 100px auto 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease-in-out;
        }

        .profile-container:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .profile-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }

        .logout-button {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 18px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-info img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        .profile-info h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .profile-info p {
            color: #777;
            font-size: 14px;
            margin: 0;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .profile-grid .profile-item {
            background-color: #f9f9f9;
            padding: 15px 20px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .profile-grid .profile-item:hover {
            background-color: #f1f1f1;
        }

        .profile-grid .profile-item p.label {
            font-size: 12px;
            color: #999;
            margin: 0 0 5px;
        }

        .profile-grid .profile-item p.value {
            font-size: 16px;
            color: #333;
            margin: 0;
            font-weight: 500;
        }

        .edit-profile-btn {
            background-color: #007bff;
            color: #fff;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 14px;
            border: none;
            transition: 0.3s;
        }

        .edit-profile-btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-info {
                flex-direction: column;
                text-align: center;
            }

            .profile-info img {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>

    <x-usersidebar />

    <div class="container profile-container">
        <!-- Profile Header -->
        <!--<div class="profile-header">-->
        <!--    <h1><i class="fas fa-user-circle"></i> My Profile</h1>-->
        <!--    <form method="POST" action="{{ route('logout') }}">-->
        <!--        @csrf-->
        <!--        <button type="submit" class="logout-button">-->
        <!--            <i class="fas fa-sign-out-alt"></i> Logout-->
        <!--        </button>-->
        <!--    </form>-->
        <!--</div>-->

        <!-- Profile Info -->
        <div class="profile-info">
            <img src="{{ Auth::user()->image ? asset('upload/' . Auth::user()->image) : asset('img/avatar.png') }}" 
                alt="Profile Image">
            <div>
                <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            </div>
        </div>

        <!-- Profile Details Grid -->
        <div class="profile-grid">

            <div class="profile-item">
                <p class="label">First Name</p>
                <p class="value">{{ $user->first_name }}</p>
            </div>

            <div class="profile-item">
                <p class="label">Last Name</p>
                <p class="value">{{ $user->last_name }}</p>
            </div>

            <div class="profile-item">
                <p class="label">Address</p>
                <p class="value">{{ $user->address }}</p>
            </div>

            <div class="profile-item">
                <p class="label">Province</p>
                <p class="value">{{ $user->province }}</p>
            </div>

            <div class="profile-item">
                <p class="label">Region</p>
                <p class="value">{{ $user->region }}</p>
            </div>

            <div class="profile-item">
                <p class="label">Zip Code</p>
                <p class="value">{{ $user->zip_code }}</p>
            </div>

            <div class="profile-item">
                <p class="label">Phone Number</p>
                <p class="value">{{ $user->phone_number }}</p>
            </div>

            <div class="profile-item">
                <p class="label">Email</p>
                <p class="value">{{ $user->email }}</p>
            </div>

<!-- Car Type -->
<!-- Cars Information -->
@foreach($user->cars as $car)
<div class="profile-item">
    <p class="label">Car Type</p>
    <p class="value">{{ $car->car_type }}</p>
</div>

<div class="profile-item">
    <p class="label">Car Model</p>
    <p class="value">{{ $car->car_model }}</p>
</div>
@endforeach


        </div>

        <!-- Edit Profile Button -->
        <div class="text-right mt-4">
            <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

</body>
</html>
