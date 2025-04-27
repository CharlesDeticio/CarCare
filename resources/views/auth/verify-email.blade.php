<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification Required</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">

    <h2>Email Verification Required</h2>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            A new verification link has been sent to your email address!
        </div>
    @endif

    <p>Please verify your email address by clicking the link we sent to your inbox.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

</body>
</html>
