<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/loginSignUp.css') }}"/>
    </head>

    <style>
        body{
            background-image: url("{{ asset('images/loginbg.jpg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>

    <body>
        <div class ="signup">                    
            <form action="{{ route('student.register') }}" method="POST" autocomplete="">
                @csrf
                <img src="{{ asset('images/logo.png') }}" alt="logo">
                <h2 class ="title"> Sign Up Now! </h2>

                @if(count($errors) > 0) 
                <div class="alert alert-danger">
                    @foreach ($errors as $error) 
                        <div>{{$error[0]}}</div>
                    @endforeach
                </div>
                @endif

                <input type = "text" class="form_input" name="name" placeholder="Enter Your Name" value="{{ $name }}" required><br><br>
                <input type = "number" class="form_input" name="student_id" placeholder="Student ID (Eg. 2104843)" value="{{ $student_id }}"  required><br><br>
                <input type = "email" class="form_input" name="email" placeholder="Email" value="{{ $email }}"  required><br><br>
                <input type = "tel" class="form_input" name="phone_number" placeholder="Phone Number (Eg. 0123456789)" value="{{ $phone_number }}"  pattern="^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" required><br><br>
                <input type ="password" class="form_input" name="password" placeholder="Password" required><br><br>
                <input type ="password" class="form_input" name="password_confirmation" placeholder="Confirm Password" required><br>
                <button type ="submit" class="btn" name="sign-up">Create Account</button>

                <div class ="stmt">
                    <a>Already have an account? </a> <a href ="{{ route('student.login') }}" class="click">Log in here.</a>
                </div>
            </form>
        </div>
    </body>
</html>