<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <title>Shop Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- ✅ FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


  <style>
  
  .password-input-group {
  position: relative;
}

.password-input-group input {
  width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      margin-bottom: 1rem;
      transition: border-color 0.2s ease-in-out;
}

.toggle-password {
  position: absolute;
  top: 37%;
  right: 12px;
  transform: translateY(-50%);
  cursor: pointer;
  color: #777;
  font-size: 1.1rem;
}

    /* Reset some default styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      min-height: 100%;
      font-family: Arial, sans-serif;
      overflow-x: hidden;
      overflow-y: auto;
    }

    body {
      position: relative;
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

    /* ✅ Main container for the card */
    .container {
      position: relative;
      z-index: 2;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 40px 20px;
    }

    /* ✅ Card-based login form */
    .form-wrapper {
      background-color: #fff;
      width: 100%;
      max-width: 400px;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    /* ✅ Logo */
    .logo-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo-container img {
      width: 120px;
    }

    /* ✅ Heading */
    .form-wrapper h3 {
      text-align: center;
      font-size: 1.8rem;
      color: #0C2E5B;
      margin-bottom: 1.5rem;
    }

    /* ✅ Session Status */
    .session-status {
      margin-bottom: 1rem;
      font-size: 0.9rem;
      color: #28a745; /* Green */
    }

    /* ✅ Labels and Inputs */
    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
      color: #333;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      margin-bottom: 1rem;
      transition: border-color 0.2s ease-in-out;
    }

    input:focus {
      border-color: #0C2E5B;
      outline: none;
    }

    /* ✅ Remember Me */
    .remember-me {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
      font-size: 0.9rem;
    }

    .remember-me input[type="checkbox"] {
      width: 16px;
      height: 16px;
      margin-right: 8px;
      cursor: pointer;
    }

    /* ✅ Links Row */
    .action-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .action-row a {
      color: #0C2E5B;
      text-decoration: none;
    }

    .action-row a:hover {
      text-decoration: underline;
    }

    /* ✅ Buttons */
    .btn-primary {
      background-color: #0C2E5B;
      color: #fff;
      border: none;
      padding: 12px 20px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s;
      font-weight: 500;
      width: 100%;
    }

    .btn-primary:hover {
      background-color: #092046;
    }

    /* ✅ Error messages */
    .error-message {
      color: #dc3545;
      font-size: 0.9rem;
      margin-bottom: 0.75rem;
    }

    .success-message {
      color: #28a745;
      font-size: 0.9rem;
      margin-bottom: 0.75rem;
    }

    /* ✅ Responsive */
    @media (max-width: 480px) {
      .form-wrapper {
        padding: 30px 20px;
      }

      .logo-container img {
        width: 100px;
      }

      .form-wrapper h3 {
        font-size: 1.5rem;
      }

      .action-row {
        flex-direction: column;
        gap: 10px;
      }

      .action-row a {
        text-align: center;
      }
    }

    /* Divider */
    .divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 15px 0;
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
    margin-bottom: 15px;
}

.btn-secondary:hover {
    background-color: #0C2E5B;
    color: #ffffff;
}


  </style>
</head>
<body>

  <!-- ✅ Background and Overlay -->
  <div class="background-blur"></div>
  <div class="overlay"></div>

  <!-- ✅ Container -->
  <div class="container">

    <!-- ✅ Login Card -->
    <div class="form-wrapper">

      <!-- ✅ Logo -->
      <div class="logo-container">
        <img src="{{ asset('images/carcare.avif') }}" alt="Carcare Logo">
      </div>

      <!-- ✅ Title -->
      <h3>Shop Login</h3>

      <!-- ✅ Success Message After Registration -->
      @if(session('success'))
        <div class="success-message">
          {{ session('success') }}
        </div>
      @endif

      <!-- ✅ Session Status -->
      <x-auth-session-status class="session-status" :status="session('status')" />

      <!-- ✅ Error Handling -->
      @if(session('error'))
        <div class="error-message">
          {{ session('error') }}
        </div>
      @endif

      <!-- ✅ Login Form -->
      <form method="POST" action="{{ route('mechanic.login') }}" id="mechanicLoginForm">
        @csrf

        <!-- Email -->
        <div>
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input 
            id="email"
            type="email"
            name="email"
            :value="old('email')"
            required 
            autofocus 
            autocomplete="username"
          />
          <x-input-error :messages="$errors->get('email')" class="error-message" />
        </div>

        <!-- Password -->
        <!-- Password -->
<div>
  <x-input-label for="password" :value="__('Password')" />
  <div class="password-input-group">
    <x-text-input 
      id="password"
      type="password"
      name="password"
      required 
      autocomplete="current-password"
    />
    <span toggle="#password" class="fa fa-eye-slash toggle-password"></span>
  </div>
  <x-input-error :messages="$errors->get('password')" class="error-message" />
</div>


        <!-- Remember Me -->
        <div class="remember-me">
          <input id="remember_me" type="checkbox" name="remember">
          <label for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <!-- ✅ Log in Button -->
        <div style="margin-top: 1rem;">
          <button type="submit" class="btn-primary" id="mechanicLoginBtn">
            {{ __('Log in') }}
          </button>
        </div>
        
        <div style="margin-top: 10px;">
  <a href="{{ route('mechanic.register') }}" class="btn-secondary" style="text-align: center;">Create Account</a>
</div>

<!-- ✅ Links Row -->
        <div class="action-row">
          <!--@if (Route::has('mechanic.register'))-->
          <!--  <a href="{{ route('mechanic.register') }}">{{ __('Create Account?') }}</a>-->
          <!--@endif-->

          @if (Route::has('mechanic.password.request'))
            <a href="{{ route('mechanic.password.request') }}">{{ __('Forgot Password?') }}</a>
          @endif
        </div>

        <!-- ✅ Divider -->
<div class="divider">
  <span>or</span>
</div>

<!-- Login as Customer Button -->
<a href="{{ route('login') }}" class="btn-secondary">
  <i class="fas fa-user" style="margin-right: 8px;"></i> {{ __('Sign in as Customer') }}
</a>

<!-- Register as Customer Button -->
<!--<a href="{{ route('register') }}" class="btn-secondary">-->
<!--  <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Sign up as Customer-->
<!--</a>-->



        

      </form>

    </div><!-- .form-wrapper -->

  </div><!-- .container -->

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const loginForm = document.getElementById('mechanicLoginForm');
      const loginBtn = document.getElementById('mechanicLoginBtn');
  
      loginForm.addEventListener('submit', function () {
        loginBtn.disabled = true;
        loginBtn.innerHTML = `
          <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
          Logging in...
        `;
      });
    });
  </script>
  
  <script>
  document.querySelectorAll('.toggle-password').forEach(function (toggle) {
    toggle.addEventListener('click', function () {
      const input = document.querySelector(this.getAttribute('toggle'));
      const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
      input.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  });
</script>

  

</body>
</html>
