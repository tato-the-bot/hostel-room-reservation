<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <!--font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/loginSignUp.css">
    </head>
    
    <style>
        body{
            background-image: url("images/login2.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>
    
    <body>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class ="login">
                <a href="{{ route('home') }}"> 
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                </a>
                <h2 class = "title">WELCOME!</h2>
                
                <input type="text" class="form_input" name="student_id" placeholder="email" required><br><br>
                <input type="password" class="form_input" name="password" id="password" placeholder="Password" required><br>
                
                <button type="submit" class="btn">Log In</button>
            </div>
        </form>
    </body>
</html>
