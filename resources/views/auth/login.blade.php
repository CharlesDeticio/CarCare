<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare - Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

        /* ✅ Overlay for contrast */
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
            padding: 30px 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* ✅ Logo */
        .logo-container {
            text-align: center;
            margin-bottom: 5px;
        }

        .logo-container img {
            width: 100px;
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
            /*margin-top: 10px;*/
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
                width: 80px;
            }

            .login-card {
                padding: 30px 20px;
            }
        }

        /* Divider Line */
.divider {
    display: flex;
    align-items: center;
    text-align: center;
    /*margin: 15px 0;*/
    color: #777;
    font-size: 0.9rem;
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #ccc;
}

.divider:not(:empty)::before {
    margin-right: 0.75em;
}

.divider:not(:empty)::after {
    margin-left: 0.75em;
}

/* Login as Shop Button */
.btn-secondary {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #ffffff;
    color: #0C2E5B;
    border: 2px solid #0C2E5B;
    padding: 12px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
    font-weight: 500;
    text-decoration: none;
}

.btn-secondary:hover {
    background-color: #0C2E5B;
    color: #ffffff;
}

.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.password-wrapper {
    position: relative;
}

.password-input-group {
    position: relative;
}

.password-input-group input {
    width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: border-color 0.3s;
    
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #777;
    font-size: 1.1rem;
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
                <img src="{{ asset('images/carcare.avif') }}" alt="Carcare Logo">
            </div>

            <!-- ✅ Title -->
            <h6 class="login-title">Log In</h6>

            <!-- ✅ Status Messages -->
            @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-info">{{ session('success') }}</div>
        @endif
            

            <!-- ✅ Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
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
                <div class="password-wrapper">
                    <label for="password">Password</label>
                        <div class="password-input-group">
                            <input id="password" type="password" name="password" required autocomplete="current-password">
                                <span toggle="#password" class="fa fa-eye-slash toggle-password"></span>
                        </div>
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
                <button type="submit" class="btn-primary" id="loginBtn">Log in</button>
                
                <!-- Create Account Link (make it a button) -->
<div style="margin-top: 10px;">
    <a href="{{ route('register') }}" class="btn-secondary" style="text-align: center;">Create Account</a>
</div>

<!-- Action Links -->
                <div class="action-links">
                    <!--@if (Route::has('register'))-->
                    <!--    <a href="{{ route('register') }}">Create Account?</a>-->
                    <!--@endif-->
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                <!-- Divider with text -->
<div class="divider">
    <span>or</span>
</div>

<!-- Login as Shop Button -->
<a href="{{ route('mechanic.login') }}" class="btn-secondary">
    <i class="fas fa-store-alt" style="margin-right: 8px;"></i> Sign in as Shop Owner
</a>

<!-- Register as Shop Button -->
<!--<a href="{{ route('mechanic.register') }}" class="btn-secondary">-->
<!--    <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Sign up as Shop Owner-->
<!--</a>-->

                

            </form>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');

        form.addEventListener('submit', function () {
            loginBtn.disabled = true;
            loginBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Logging in...
            `;
        });

        // Toggle Password Visibility
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>

    

</body>
</html>
