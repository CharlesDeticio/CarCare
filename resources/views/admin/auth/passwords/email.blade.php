<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Forgot Password</title>
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
        input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }
        input[type="email"]:focus {
            border-color: #2563eb;
            outline: none;
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
        .status, .error {
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }
        .status {
            color: #059669;
        }
        .error {
            color: #dc2626;
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
        <h2>Admin Forgot Password</h2>

        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Send Reset Link</button>
        </form>

        <a href="{{ route('admin.login') }}" class="back-link">Back to Login</a>
    </div>

</body>
</html>
