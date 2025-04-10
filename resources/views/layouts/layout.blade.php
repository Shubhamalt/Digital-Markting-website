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
    <div class="chat-wrapper">
        @auth
            <div class="card chat-container" id="chatContainer">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Chat Assistant</span>
                    <button type="button" class="btn btn-sm btn-light" onclick="toggleChat()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="card-body messages-container p-3" id="messages">
                    <!-- Initial message -->
                    <div class="d-flex mb-3">
                        <div class="message-bubble bot-message p-3">
                            <p class="mb-0">Hello! How can I help you today?</p>
                            <small class="text-muted d-block mt-1">Just now</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input type="text" class="form-control" id="userInput" placeholder="Type your message...">
                        <button class="btn btn-primary" type="button" onclick="sendMessage()">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Floating Action Button -->
            <button class="btn btn-primary chat-toggle-btn shadow-lg" onclick="toggleChat()">
                <i class="fas fa-comment-dots fa-lg"></i>
            </button>
        </div>
    @else
        <div class="card chat-container" id="guestMessage">
            <div class="card-body text-center">
                <h5>Please sign in to chat</h5>
                <a href="{{ route('login') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </a>
                @if (Route::has('register'))
                    <p class="mt-2">Don't have an account?
                        <a href="{{ route('register') }}">Register</a>
                    </p>
                @endif
            </div>
        </div>
        <button class="chat-toggle-btn" onclick="showAuthMessage()">
            <i class="fas fa-comment-dots fa-lg"></i>
        </button>
    @endauth
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleChat() {
            const chatContainer = document.getElementById('chatContainer');
            chatContainer.classList.toggle('show');
        }

        function appendMessage(message, isUser = true) {
            const messagesDiv = document.getElementById('messages');
            const time = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });

            // Create message container
            const messageDiv = document.createElement('div');
            messageDiv.className = `d-flex mb-3 ${isUser ? 'justify-content-end' : 'justify-content-start'}`;

            // Create message bubble
            const bubble = document.createElement('div');
            bubble.className = `message-bubble p-3 ${
        isUser ? 'user-message bg-primary text-white' : 'bot-message bg-light'
    }`;

            // Create message content
            const content = document.createElement('p');
            content.className = 'mb-0';
            content.textContent = message;

            // Create timestamp
            const timestamp = document.createElement('small');
            timestamp.className = 'timestamp text-muted d-block mt-1';
            timestamp.textContent = time;

            // Assemble elements
            bubble.appendChild(content);
            bubble.appendChild(timestamp);
            messageDiv.appendChild(bubble);
            messagesDiv.appendChild(messageDiv);

            // Scroll to bottom
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        async function sendMessage() {
            const input = document.getElementById('userInput');
            const message = input.value.trim();

            if (!message) return;

            // Immediately show user message
            appendMessage(message, true);
            input.value = '';

            try {
                const response = await fetch("{{ route('chat.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message
                    })
                });

                if (!response.ok) throw new Error('Network response error');

                const data = await response.json();
                appendMessage(data.response, false);

            } catch (error) {
                console.error('Error:', error);
                appendMessage('Sorry, there was an error processing your request', false);
            }
        }

        function showAuthMessage() {
            document.getElementById('guestMessage').classList.toggle('show');
        }

        // Handle Enter key
        document.getElementById('userInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
