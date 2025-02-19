<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/Signin.css" type="text/css">
</head>
<body>

    @include('Component.Header')

    <div class="container">

        <div class="form-container mx-auto shadow-lg">
            <h2>Login</h2>
            <form action="{{route('signin')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-submit">Login</button>
            </form>
            <div class="redirect-link">
                <p>Do you have an account? <a href="{{route('signup')}}">Signup</a></p>
            </div>
        </div>
    </div>

    @include('Component.Footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
