<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Mechanic Portal</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .otp-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            font-weight: 600;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.25rem;
        }
        .otp-input-container {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin: 1.5rem 0;
        }
        .otp-input {
            width: 3rem;
            height: 3.5rem;
            text-align: center;
            font-size: 1.5rem;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .otp-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            outline: none;
        }
        .btn-verify {
            padding: 0.5rem 2rem;
            font-weight: 500;
        }
        .resend-link {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }
        .resend-link:hover {
            text-decoration: underline;
        }
        .email-display {
            background-color: #e9ecef;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: 500;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card otp-card">
                    <div class="card-header">{{ __('OTP Verification') }}</div>

                    <div class="card-body p-4">
                        <!-- Error Message -->
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Success Message -->
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="email-display">
                            Code sent to: <strong>{{ session('email') }}</strong>
                        </div>

                        <form method="POST" action="{{ route('mechanic.verify.otp.submit') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('email') }}">

                            <!-- OTP Input -->
                            <div class="mb-4">
                                <label for="otp" class="form-label text-center d-block mb-3">
                                    <strong>Enter 6-digit verification code</strong>
                                </label>
                                
                                <div class="otp-input-container">
                                    <input type="text" name="otp1" maxlength="1" class="otp-input" autofocus>
                                    <input type="text" name="otp2" maxlength="1" class="otp-input">
                                    <input type="text" name="otp3" maxlength="1" class="otp-input">
                                    <input type="text" name="otp4" maxlength="1" class="otp-input">
                                    <input type="text" name="otp5" maxlength="1" class="otp-input">
                                    <input type="text" name="otp6" maxlength="1" class="otp-input">
                                </div>
                                
                                <!-- Hidden field for complete OTP -->
                                <input type="hidden" name="otp" id="fullOtp">
                                
                                @error('otp')
                                    <div class="text-danger text-center mt-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <button type="submit" class="btn btn-primary btn-verify">
                                    {{ __('Verify') }}
                                </button>

                                <a href="{{ route('mechanic.otp.resend') }}" class="resend-link" 
                                   onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
                                    {{ __('Resend Code') }}
                                </a>
                            </div>
                        </form>

                        <!-- Hidden Resend Form -->
                        <form id="resend-form" action="{{ route('mechanic.otp.resend') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('email') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
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
        });

        // Handle backspace
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });

    // 🔐 Always update OTP before form submit
    document.querySelector('form').addEventListener('submit', () => {
        const otp = Array.from(otpInputs).map(input => input.value).join('');
        fullOtpField.value = otp;
    });
</script>

</body>
</html>