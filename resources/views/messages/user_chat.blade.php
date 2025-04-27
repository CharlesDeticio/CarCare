<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Chat - Carcare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-container {
            width: 800px;
            max-width: 95%;
            height: 85vh;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            position: relative;
        }

        .back-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background-color: transparent;
            color: #fff;
            font-size: 28px;
            border: none;
            cursor: pointer;
        }

        .back-btn:hover {
            color: #ddd;
        }

        .chat-box {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
            overflow-y: auto;
            max-height: calc(100% - 160px);
        }

        .message-left,
        .message-right {
            margin-bottom: 15px;
            display: flex;
        }

        .message-left {
            justify-content: flex-start;
        }

        .message-right {
            justify-content: flex-end;
        }

        .message-content {
            display: inline-block;
            padding: 12px 16px;
            border-radius: 16px;
            max-width: 70%;
            word-wrap: break-word;
        }

        .message-sent {
            background-color: #007bff;
            color: #fff;
            border-bottom-right-radius: 0;
        }

        .message-received {
            background-color: #e9ecef;
            color: #333;
            border-bottom-left-radius: 0;
        }

        .message-time {
            font-size: 11px;
            color: #777;
            margin-top: 5px;
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

        @media (max-width: 576px) {
            .chat-container {
                width: 100%;
                height: 100vh;
                border-radius: 0;
            }

            .chat-header {
                font-size: 20px;
                padding: 15px;
            }

            .chat-box {
                max-height: calc(100% - 140px);
                padding: 15px;
            }

            .chat-footer {
                padding: 15px;
            }

            .chat-footer button {
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body>

    <div class="chat-container">

        <!-- Chat Header -->
        <div class="chat-header">
            Chat with {{ $receiver->shopname ?? 'Mechanic' }}
            <!-- Back button -->
            <button class="back-btn" onclick="window.location.href='{{ route('user.messages.chatList') }}'">&times;</button>
        </div>

        <!-- Chat Messages -->
        <div class="chat-box" id="chat-box">
            @forelse ($messages as $message)
                <div class="{{ $message->sender_type === 'user' ? 'message-right' : 'message-left' }}">
                    <div class="message-content {{ $message->sender_type === 'user' ? 'message-sent' : 'message-received' }}">
                        {{ $message->message }}
                        <div class="message-time">{{ $message->created_at->format('H:i') }}</div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">No messages yet.</div>
            @endforelse
        </div>

        <!-- Send Message Form -->
        <form method="POST" action="{{ route('user.messages.send') }}" class="chat-footer">
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
