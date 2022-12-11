<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/loginSignUp.css') }}">
    </head>
    <body>
        <div class="fp-page">
            <form method="POST" autocomplete="off">
                @csrf
                <h2 class="title">Change Password</h2>
                
                @if(count($errors) > 0) 
                <div class="alert alert-danger">
                    @foreach ($errors as $error) 
                        <div>{{$error[0]}}</div>
                    @endforeach
                </div>
                @endif

                <input class="form_box" type="password" name="old_password" placeholder="Enter old password" required><br><br>
                <input class="form_box" type="password" name="password" placeholder="Enter new password" required><br><br>
                <input class="form_box" type="password" name="password_confirmation" placeholder="Confirm password" required><br><br>
                <button class="btn" type="submit" name="change-password" onclick="'{{ route('student.login') }}'">Confirm Change Password</button>
            </form>
        </div>
    </body>
</html>
