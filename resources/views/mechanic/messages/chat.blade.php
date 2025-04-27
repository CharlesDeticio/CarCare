<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mechanic Chat - Carcare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-container {
            width: 800px;
            max-width: 95%;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .chat-header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            position: relative;
        }

        /* Back X Button */
        .back-button {
            position: absolute;
            top: 15px;
            right: 20px;
            background: transparent;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .back-button:hover {
            color: #ddd;
        }

        .chat-box {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
            overflow-y: auto;
            max-height: 500px;
        }

        .message-left,
        .message-right {
            margin-bottom: 15px;
        }

        .message-left {
            text-align: left;
        }

        .message-right {
            text-align: right;
        }

        .message-content {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 15px;
            max-width: 70%;
            word-wrap: break-word;
            position: relative;
        }

        .message-sent {
            background-color: #4F46E5;
            color: #fff;
        }

        .message-received {
            background-color: #dee2e6;
            color: #333;
        }

        .message-time {
            font-size: 10px;
            margin-top: 5px;
            color: #666;
        }

        .chat-footer {
            padding: 20px;
            background-color: #f1f1f1;
            display: flex;
            gap: 10px;
        }

        .chat-footer input[type="text"] {
            flex-grow: 1;
            border-radius: 30px;
            border: 1px solid #ccc;
            padding: 10px 15px;
        }

        .chat-footer button {
            border-radius: 30px;
            padding: 10px 20px;
        }

        /* Scrollbar Styling */
        .chat-box::-webkit-scrollbar {
            width: 8px;
        }

        .chat-box::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .chat-box::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 4px;
        }

        @media (max-width: 576px) {
            .chat-container {
                width: 100%;
                height: 100vh;
                border-radius: 0;
            }

            .chat-box {
                max-height: 400px;
            }

            .chat-header {
                font-size: 20px;
                padding: 15px;
            }

            .chat-footer {
                padding: 15px;
            }

            .chat-footer button {
                padding: 8px 16px;
            }

            .back-button {
                font-size: 20px;
                top: 10px;
                right: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="chat-container">
        <!-- Chat Header -->
        <div class="chat-header">
            Chat with {{ $receiver->first_name ?? 'User' }}
            <!-- Back Button (X) -->
            <button class="back-button" onclick="window.location.href='{{ route('mechanic.messages.chatList') }}'">&times;</button>
        </div>

        <!-- Chat Messages -->
        <div class="chat-box" id="chat-box">
            @forelse ($messages as $message)
                <div class="{{ $message->sender_type === 'mechanic' ? 'message-right' : 'message-left' }}">
                    <div class="message-content {{ $message->sender_type === 'mechanic' ? 'message-sent' : 'message-received' }}">
                        {{ $message->message }}
                        <div class="message-time">{{ $message->created_at->format('H:i') }}</div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">No messages yet.</div>
            @endforelse
        </div>

        <!-- Send Message Form -->
        <form method="POST" action="{{ route('mechanic.messages.send') }}" class="chat-footer">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <input type="text" name="message" placeholder="Type your message..." required>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

    <!-- Scroll to bottom on load -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chatBox = document.getElementById('chat-box');
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>

</body>

</html>
