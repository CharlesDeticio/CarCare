<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare Admin - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            min-height: 100%;
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
        }

        body {
            position: relative;
            overflow-y: auto;
        }

        /* ✅ Blurred Background Image */
        .background-blur {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/mechanic.jpg') }}') no-repeat center center;
            background-size: cover;
            filter: blur(8px);
            z-index: 0;
        }

        /* ✅ Dark Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        /* ✅ Centered Container */
        .container {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* ✅ Registration Card */
        .register-card {
            background-color: #ffffff;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* ✅ Logo */
        .logo-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo-container img {
            width: 120px;
        }

        /* ✅ Heading */
        .register-title {
            text-align: center;
            font-size: 2rem;
            color: #0C2E5B;
            margin-bottom: 20px;
        }

        /* ✅ Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #0C2E5B;
            outline: none;
        }

        /* ✅ Buttons */
        .btn-register {
            background: linear-gradient(90deg, #0C2E5B 0%, #233f6f 100%);
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            font-weight: 600;
        }

        .btn-register:hover {
            background: linear-gradient(90deg, #0c2655 0%, #1e3252 100%);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .btn-register:active {
            transform: scale(0.98);
            box-shadow: none;
        }

        .btn-cancel {
            background-color: #fff;
            color: #0C2E5B;
            border: 2px solid #0C2E5B;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: 500;
        }

        .btn-cancel:hover {
            background-color: #f3f3f3;
        }

        /* ✅ Action Buttons */
        .button-row {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        /* ✅ Responsive Design */
        @media (max-width: 480px) {
            .register-card {
                padding: 30px 20px;
            }

            .logo-container img {
                width: 100px;
            }

            .register-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- ✅ Background & Overlay -->
    <div class="background-blur"></div>
    <div class="overlay"></div>

    <!-- ✅ Container -->
    <div class="container">
        <div class="register-card">

            <!-- ✅ Logo -->
            <div class="logo-container">
                <img src="{{ asset('images/carcare.avif') }}" alt="Carcare Admin">
            </div>

            <!-- ✅ Title -->
            <h2 class="register-title">Admin Register</h2>

            <!-- ✅ Registration Form -->
            <form method="POST" action="{{ route('admin.register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    <x-input-error :messages="$errors->get('name')" class="text-red-600" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    <x-input-error :messages="$errors->get('email')" class="text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                    <x-input-error :messages="$errors->get('password')" class="text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-600" />
                </div>

                <!-- ✅ Buttons -->
                <div class="button-row">
                    <a class="btn-cancel" href="{{ route('admin.login') }}">Cancel</a>
                    <button type="submit" class="btn-register">Register</button>
                </div>

            </form>

        </div>
    </div>

</body>
</html>
