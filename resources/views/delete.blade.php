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
                <h2 class="title">Delete Account</h2>
                
                @if(count($errors) > 0) 
                <div class="alert alert-danger">
                    @foreach ($errors as $error) 
                        <div>{{$error[0]}}</div>
                    @endforeach
                </div>
                @endif

                <label>Enter your password</label>
                <input class="form_box" type="password" name="password" placeholder="Enter your password" required><br><br>
                <button class="btn" type="submit" id="delete">Confirm</button>
            </form>
            <script>
                $('#delete').click(function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to delete the account?')) {
                        location.href = "{{ route('delete') }}";
                    } else {
                        return false;
                    }
                });
            </script>
        </div>
    </body>
</html>
