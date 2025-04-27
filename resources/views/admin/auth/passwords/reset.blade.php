<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }
        input:focus {
            border-color: #2563eb;
            outline: none;
        }
        input[readonly] {
            background-color: #f9f9f9;
            cursor: not-allowed;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1d4ed8;
        }
        .error {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #2563eb;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Admin Reset Password</h2>

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" readonly required>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">New Password</label>
            <input id="password" type="password" name="password" required>

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password_confirmation">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>

            <button type="submit">Reset Password</button>
        </form>

        <a href="{{ route('admin.login') }}" class="back-link">Back to Login</a>
    </div>

</body>
</html>
