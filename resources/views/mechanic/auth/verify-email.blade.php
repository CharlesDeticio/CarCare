<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Verify Mechanic Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap (Optional if you're using it already) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .verification-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .verification-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            overflow: hidden;
        }

        .verification-header {
            background-color: #077bff; /* Bootstrap warning color */
            color: #212529;
            padding: 20px;
            text-align: center;
        }

        .verification-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .verification-body {
            padding: 30px;
        }

        .verification-body p {
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .btn-resend {
            background-color: #077bff;
            color: #212529;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-resend:hover {
            background-color: #e0a800;
        }

        .btn-logout {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #0C2E5B;
            text-decoration: underline;
            font-weight: 500;
        }

        .btn-logout:hover {
            color: #092046;
            text-decoration: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

    </style>
</head>

<body>

    <div class="verification-container">
        <div class="verification-card">

            <div class="verification-header">
                <h4>{{ __('Verify Your Mechanic Email') }}</h4>
            </div>

            <div class="verification-body">

                @if (session('status') == 'verification-link-sent')
                    <div class="alert-success">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p>{{ __('Before continuing, please check your email for a verification link.') }}</p>

                <form method="POST" action="{{ route('mechanic.verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-resend">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('mechanic.logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        {{ __('Logout') }}
                    </button>
                </form>

            </div>

        </div>
    </div>

</body>

</html>
