<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Approved</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        h1 {
            color: #2e7d32; /* Green color */
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            color: #555555;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background-color: #2e7d32;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1b5e20;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 20px;
            }

            h1 {
                font-size: 20px;
            }

            p, .btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Congratulations {{ $mechanic->name }}!</h1>
        <p>Your mechanic account has been approved.<br> You can now access your dashboard and manage your shop on <strong>Carcare</strong>.</p>
        <a href="{{ route('mechanic.login') }}" class="btn">Go to Login</a>
    </div>
</body>
</html>
