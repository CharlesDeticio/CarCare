<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - OTP Verification</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .otp-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
        }
        .otp-input {
            width: 3rem;
            height: 3.5rem;
            text-align: center;
            font-size: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f8fafc;
        }
        .otp-input:focus {
            outline: 2px solid #6366f1;
            border-color: transparent;
        }
        .resend-link {
            color: #6366f1;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col justify-center items-center px-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-sm p-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Enter Verification Code</h2>
                <p class="text-gray-600 mt-2">We've sent a 6-digit code to your email</p>
            </div>

            <!-- OTP Form -->
            <form method="POST" action="{{ route('otp.verify.submit') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">

                <!-- OTP Input Dots -->
                <div class="otp-container">
                    <input type="text" name="otp1" maxlength="1" class="otp-input" autofocus>
                    <input type="text" name="otp2" maxlength="1" class="otp-input">
                    <input type="text" name="otp3" maxlength="1" class="otp-input">
                    <input type="text" name="otp4" maxlength="1" class="otp-input">
                    <input type="text" name="otp5" maxlength="1" class="otp-input">
                    <input type="text" name="otp6" maxlength="1" class="otp-input">
                </div>

                <!-- Hidden field for complete OTP -->
                <input type="hidden" name="otp" id="fullOtp">

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                    Verify
                </button>
            </form>

            <!-- Resend OTP -->
            <div class="text-center mt-6">
                <p class="text-gray-600">Didn't receive the code?</p>
                <form id="resend-form" action="{{ route('otp.resend') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <button type="submit" class="resend-link">Resend OTP</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus and move between OTP inputs
        const otpInputs = document.querySelectorAll('.otp-input');
        const fullOtpField = document.getElementById('fullOtp');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                
                // Combine all OTP digits
                const otp = Array.from(otpInputs).map(input => input.value).join('');
                fullOtpField.value = otp;
                
                // Auto-submit when all digits are entered
                if (otp.length === 6) {
                    document.forms[0].submit();
                }
            });
            
            // Handle backspace
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
    </script>
</body>
</html>