<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <!--font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/loginSignUp.css') }}">
    </head>
    
    <style>
        body{
            background-image: url("{{ asset('images/login2.jpg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>
    
    <body>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class ="login">
                <a href="{{ route('home') }}"> 
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                </a>
                <h2 class = "title">WELCOME!</h2>

                @if(count($errors) > 0) 
                <div class="alert alert-danger">
                    @foreach ($errors as $error) 
                        <div>{{$error[0]}}</div>
                    @endforeach
                </div>
                @endif

                <input type="email" class="form_input" name="email" placeholder="Email" value="{{ $email }}" required><br><br>
                <input type="password" class="form_input" name="password" id="password" placeholder="Password" required><br>
                <input type="checkbox" onclick="myFunction()">Show password

                <div class ="forget_pwd" style="margin-top: -30px;">
                    <a href ="{{ route('admin.login.forget-password') }}" id="forget-line">Forgot password?</a>
                </div> 

                <button type ="submit" class="btn" name="login">Log In</button>

                <div class ="stmt"> 
                    <a>Don't have an account yet? </a> <a href ="{{ route('admin.register') }}" class="click">Sign up now!</a><br>
                </div>
            </div>
        </form>
        <script>
        function myFunction(){
            var x = document.getElementById("password");
            if(x.type === "password"){
                x.type = "text";
            } else{
                x.type = "password";
            }            
        }
        </script>
    </body>
</html>
