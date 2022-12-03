<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Code Verification</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/loginSignUp.css') }}">
    <body>
    </head>
        <div class="fp-page">
            <form method="POST" autocomplete="off">
                @csrf
                <h2 class="title">Code Verification</h2>
                @if(count($errors) > 0) 
                <div class="alert alert-danger">
                    @foreach ($errors as $error) 
                        <div>{{$error[0]}}</div>
                    @endforeach
                </div>
                @endif

                <input class="form_box" type="number" name="otp" placeholder="Enter verification code" required>
                <button type="submit" class="btn" name="check">Submit</button>
            </form>
        </div>
    </body>
</html>