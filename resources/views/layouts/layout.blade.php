<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SticMarketing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <!-- Page Content Sections -->
    @yield('register')
    @yield('login')
    @yield('home')
    @yield('about')
    @yield('book')
    @yield('forgotpassword')
    @yield('resetpassword')
    @yield('verifyEmail')
    @yield('Mailstatus')
    @yield('admin')
    @yield('chatlog')

    <!-- Chatbot Section (Only visible on Home/About/Book pages) -->
    @if(Request::is('/') || Request::is('about') || Request::is('book'))
    <div class="chat-wrapper">
        @auth
        <!-- Authenticated User Chat -->
        <div class="card chat-container" id="chatContainer">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Chat Assistant</span>
                <button type="button" class="btn btn-sm btn-light" onclick="toggleChat()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="card-body messages-container p-3" id="messages">
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
        <button class="btn btn-primary chat-toggle-btn shadow-lg" onclick="toggleChat()">
            <i class="fas fa-comment-dots fa-lg"></i>
        </button>
        @else
        <!-- Guest Message -->
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
    </div>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Chat Scripts (Only loaded on Home/About/Book pages) -->
    @if(Request::is('/') || Request::is('about') || Request::is('book'))
    <script>
        // Toggle chat visibility
        function toggleChat() {
            const chat = document.getElementById('chatContainer') || document.getElementById('guestMessage');
            chat?.classList.toggle('show');
        }

        // Add new messages to chat
        function appendMessage(message, isUser = true) {
            const messagesDiv = document.getElementById('messages');
            if (!messagesDiv) return;

            // Create message elements
            const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const messageDiv = document.createElement('div');
            messageDiv.className = `d-flex mb-3 ${isUser ? 'justify-content-end' : 'justify-content-start'}`;

            // Message bubble
            const bubble = document.createElement('div');
            bubble.className = `message-bubble p-3 ${isUser ? 'user-message bg-primary text-white' : 'bot-message bg-light'}`;
            
            // Message content
            const content = document.createElement('p');
            content.className = 'mb-0';
            content.textContent = message;

            // Timestamp
            const timestamp = document.createElement('small');
            timestamp.className = 'text-muted d-block mt-1';
            timestamp.textContent = time;

            // Assemble elements
            bubble.appendChild(content);
            bubble.appendChild(timestamp);
            messageDiv.appendChild(bubble);
            messagesDiv.appendChild(messageDiv);

            // Auto-scroll to bottom
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        // Handle message sending
        async function sendMessage() {
            const input = document.getElementById('userInput');
            if (!input) return;

            const message = input.value.trim();
            if (!message) return;

            try {
                // Add user message
                appendMessage(message, true);
                input.value = '';

                // Send to server
                const response = await fetch("{{ route('chat.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ message })
                });

                // Handle response
                if (!response.ok) throw new Error('Failed to send message');
                const data = await response.json();
                appendMessage(data.response, false);

            } catch (error) {
                console.error('Error:', error);
                appendMessage('Sorry, there was an error processing your request', false);
            }
        }

        // Show auth message for guests
        function showAuthMessage() {
            const guestMessage = document.getElementById('guestMessage');
            guestMessage?.classList.toggle('show');
        }

        // Enter key support
        document.getElementById('userInput')?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });
    </script>
    @endif
</body>
</html>