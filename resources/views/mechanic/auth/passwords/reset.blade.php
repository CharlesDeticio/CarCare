<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Mechanic Password</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 12px;
            background-color: #3b82f6;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2563eb;
        }

        .alert {
            padding: 12px;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Reset Mechanic Password</h2>

        <!-- Example Status Message (You can enable this in the controller) -->
        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('mechanic.password.update') }}">
            @csrf

            <!-- Hidden Token (required for Laravel password reset flow) -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email"
       type="email"
       name="email"
       value="{{ $email ?? old('email') }}"
       readonly
       required>


                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password"
                       type="password"
                       name="password"
                       required>

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password-confirm">Confirm New Password</label>
                <input id="password-confirm"
                       type="password"
                       name="password_confirmation"
                       required>
            </div>

            <button type="submit" class="btn">Reset Password</button>
        </form>

        <a href="{{ route('mechanic.login') }}" class="back-link">Back to Login</a>
    </div>

</body>
</html>
