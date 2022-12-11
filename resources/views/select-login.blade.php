<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/loginSignUp.css">
    </head>
    <body>
        <div class = "login">
            <a href="{{ route('home') }}"> 
                <img src="{{ asset('images/logo.png') }}" alt="logo">
            </a>
            <h2 class = "title" >Choose where to log in</h2>
            <button type="button" onclick="location.href = '{{ route('student.login') }}'" class="btn">Log in as Student</button>
            <button type="button" onclick="location.href = '{{ route('agent.login') }}'" class="btn">Log in as Agent</button>
            <button type="button" onclick="location.href = '{{ route('admin.login') }}'" class="btn">Log in as Admin</button>
        </div>
    </body>
</html>
