<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SticMarketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--font link-->
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!--icon link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    @yield('register')
    @yield('login')
    @yield('home')
    @yield('about')
    @yield('book')
    @yield('forgotpassword')
    @yield('resetpassword')
    @yield('verifyEmail')
    @yield('admin')
    @yield('Mailstatus')
    @yield('chat')
    <!--
<div id="content" class="overlap">

        <div>
            <div class="card text-dark p-1 chatdisplay">
                <div class="card-body" id="chatbox">
                    <h5 class="card-title">Let's chat</h5>
                    <p class="card-text"></p>
                </div>
            </div>

            <div>
                <input class="messagebox" type="text" id="message" placeholder="Type your message">
                <button id="send" class="sendbtn">Send</button>
            </div>

        </div>
    </div>
    <div class="letchat overlap">
        <button onclick="toggleChatbox()" class="chatbtn">Chatbot</button>

    </div>

    

    <script>
        const chatbox = document.getElementById('chatbox');
        const messageInput = document.getElementById('message');

        document.getElementById('send').addEventListener('click', function() {
            const message = messageInput.value;
            axios.post('/send-message', {
                    message
                })
                .then(response => {
                    appendMessage('You: ' + message);
                    appendMessage('Bot: ' + response.data.reply);
                });
            messageInput.value = '';
        });

        function sendSuggestion(suggestion) {
            sendMessage(suggestion);
        }

        function sendMessage(message) {
            axios.post('/send-message', {
                    message
                })
                .then(response => {
                    appendMessage('You: ' + message);
                    appendMessage('Bot: ' + response.data.reply);
                });
        }

        function appendMessage(message) {
            const p = document.createElement('p');
            p.textContent = message;
            chatbox.appendChild(p);
            chatbox.scrollTop = chatbox.scrollHeight;
        }

        //hide and show button
        function toggleChatbox() {
            var chatbox = document.getElementById('content');
            if (chatbox.style.display === 'none' || chatbox.style.display === '') {
                chatbox.style.display = 'block';
            } else {
                chatbox.style.display = 'none';
            }
        }
    </script>
-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
