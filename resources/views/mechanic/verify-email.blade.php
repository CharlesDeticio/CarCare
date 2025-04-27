<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
</head>
<body>
    <h1>Email Verification Required</h1>

    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    <p>Please check your email and click the verification link to proceed.</p>

    <form method="POST" action="{{ route('mechanic.verification.send') }}">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>

    {{-- <p>Already verified? <a href="{{ route('mechanic.dashboard') }}">Go to Dashboard</a></p> --}}
</body>
</html>
