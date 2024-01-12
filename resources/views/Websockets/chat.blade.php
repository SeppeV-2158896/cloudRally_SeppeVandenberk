<!DOCTYPE html>
<html lang="en">

<head>
    <title>Incognito Chat Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
        }

        #chat {
            padding: 20px;
            background-color: #fff;
        }

        #username-form {
            text-align: center;
            margin-top: 20px;
        }

        #message-input {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">IncognitoChat</h1>
        <div id="chat" class="jumbotron">
            <ul id="messages"></ul>
        </div>
        <div id="username-form">
            <button id="open-modal" class="btn btn-success btn-lg">Join</button>
        </div>
        <div class="input-group mb-3" id="message-input" style="display: none;">
            <input type="text" id="message" class="form-control" placeholder="Type your message">
            <div class="input-group-append">
                <button id="send" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>

    <!-- Username Modal -->
    <div class="modal fade" id="usernameModal" tabindex="-1" role="dialog" aria-labelledby="usernameModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usernameModalLabel">Enter Your Username
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="usernameInput" class="form-control" placeholder="Your username">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="join" class="btn btn-primary" data-dismiss="modal">Join</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap and jQuery JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/websockets.js') }}"></script>
</body>

</html>