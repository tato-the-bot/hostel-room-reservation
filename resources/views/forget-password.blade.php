<html>
    <head>
        <meta charset="UTF-8">
        <title>Forget Password</title>
        <!--font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/loginSignUp.css') }}">
    </head>
    <body>
        <div class="fp-page">
            <form method="POST" autocomplete="">
                @csrf
                <h2 class="title">Forget Password</h2>
                <p class="desc_text">Enter your email address</p>

                @if(count($errors) > 0) 
                <div class="alert alert-danger">
                    @foreach ($errors as $error) 
                        <div>{{$error[0]}}</div>
                    @endforeach
                </div>
                @endif
                
                <input class="form_box" type="email" name="email" placeholder="Enter email address" required>
                <button class="btn" type="submit" name="check-email">Continue</button>
            </form>
        </div>
    </body>
</html>
