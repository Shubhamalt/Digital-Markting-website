@extends('layouts.layout')
@section('chat')
    <style>
        .chat-container { max-width: 800px; margin: 20px auto; }
        .messages { height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; }
        .message { margin-bottom: 10px; }
        .user-message { text-align: right; color: #007bff; }
        .bot-message { text-align: left; color: #28a745; }
    </style>
    <div class="container chat-container">
        <div class="card">
            <div class="card-header">Chatbot</div>
            <div class="card-body">
                <div class="messages" id="messages"></div>
                <div class="input-group">
                    <input type="text" id="userInput" class="form-control" placeholder="Type your message...">
                    <button class="btn btn-primary" onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const messagesDiv = document.getElementById('messages');
        const userInput = document.getElementById('userInput');
        
        function appendMessage(message, isUser = true) {
            const div = document.createElement('div');
            div.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
            div.innerHTML = `<strong>${isUser ? 'You' : 'Bot'}:</strong> ${message}`;
            messagesDiv.appendChild(div);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        function sendMessage() {
            const message = userInput.value.trim();
            if (!message) return;

            appendMessage(message, true);
            userInput.value = '';

            fetch("{{ route('chat.send') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => appendMessage(data.response, false))
            .catch(error => appendMessage('Sorry, there was an error', false));
        }
        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });
    </script>
@endsection