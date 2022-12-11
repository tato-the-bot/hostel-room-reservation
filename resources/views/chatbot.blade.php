<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hostel</title>

        <link href="{{ asset('css/chatbot.css') }}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    <body style="background-color: #ccccff">
        <div class="header">
            <!--logo-->
            <a href="{{ route('home') }}"> 
                <img  src="{{ asset('images/logo.png') }}" alt="Hu Else Hotel" width="150" height="120" style="margin-left: 0px">
            </a>
        </div>
        <div class="wrapper" style="background-color: #e6e6ff">
            <div style="background-color: #4700b3;border: #751aff" class="title">Chatbot</div>
            <div class="form">
                <div class="bot-inbox inbox">
                    <div class="icon" style="background-color: #5c00e6">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="msg-header" >
                        <p style="background-color: #4d4dff">Hello there, how can I help you?</p>
                    </div>
                </div>
            </div>
            <div class="typing-field">
                <div class="input-data">
                    <input id="data" type="text" placeholder="Type something here.." required>
                    <button style="background-color: #5200cc; border: #5200cc" id="send-btn">Send</button>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $("#send-btn").on("click", function () {
                    let value = $("#data").val();
                    let messageBox = '<div class="user-inbox inbox"><div class="msg-header"><p style="background-color:#d6d6f5">' + value + '</p></div></div>';
                    $(".form").append(messageBox);
                    $("#data").val('');

                    // start ajax code
                    $.ajax({
                        url: '{{ route("chatbot-message") }}',
                        type: 'POST',
                        data: {
                            text: value,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (result) {
                            let replay = '<div class="bot-inbox inbox"><div class="icon"  style="background-color: #5c00e6"><i class="fas fa-robot"></i></div><div class="msg-header"><p style="background-color: #4d4dff">' + result + '</p></div></div>';
                            $(".form").append(replay);
                            // when chat goes down the scroll bar automatically comes to the bottom
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    });
                });
            });
        </script>

    </body>
</html>