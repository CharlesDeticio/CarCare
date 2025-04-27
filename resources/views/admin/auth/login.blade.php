<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare Admin - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <style>
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

        /* ✅ Center Container */
        .container {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* ✅ Login Card */
        .login-card {
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
        .login-title {
            text-align: center;
            font-size: 2rem;
            color: #0C2E5B;
            margin-bottom: 20px;
        }

        /* ✅ Form Fields */
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

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #333;
        }

        /* ✅ Buttons */
        .btn-primary {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #0C2E5B;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #092046;
        }

        /* ✅ Action Links */
        .action-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .action-links a {
            color: #0C2E5B;
            text-decoration: none;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

        /* ✅ Alerts */
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* ✅ Responsive */
        @media (max-width: 480px) {
            .login-title {
                font-size: 1.5rem;
            }

            .logo-container img {
                width: 100px;
            }

            .login-card {
                padding: 30px 20px;
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
        <div class="login-card">

            <!-- ✅ Logo -->
            <div class="logo-container">
                <img src="{{ asset('images/carcare.avif') }}" alt="Carcare Admin">
            </div>

            <!-- ✅ Title -->
            <h2 class="login-title">Admin Login</h2>

            <!-- ✅ Status Messages -->
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- ✅ Login Form -->
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    @if ($errors->has('password'))
                        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="remember-row">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">Log in</button>

                <!-- Action Links -->
                <div class="action-links">
                    @if (Route::has('admin.register'))
                        <a href="{{ route('admin.register') }}">Create Account?</a>
                    @endif
                    @if (Route::has('admin.password.request'))
    <a href="{{ route('admin.password.request') }}">Forgot Password?</a>
@endif

                </div>

            </form>

        </div>
    </div>

</body>
</html>
