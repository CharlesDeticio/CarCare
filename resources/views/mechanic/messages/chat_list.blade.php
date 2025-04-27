<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mechanic Chat List - Carcare</title>
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
            width: 1000px;
            height: 85vh;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-header {
            background-color: #4F46E5;
            color: #fff;
            padding: 30px 25px;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            position: relative;
        }

        .chat-list {
            list-style: none;
            padding: 0;
            margin: 0;
            overflow-y: auto;
            flex-grow: 1;
        }

        .chat-list-item {
            display: flex;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        .chat-list-item:hover {
            background-color: #f5f5f5;
            transform: scale(1.01);
        }

        .chat-avatar {
            width: 70px;
            height: 70px;
            background-color: #dee2e6;
            border-radius: 50%;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 28px;
            color: #495057;
        }

        .chat-info {
            flex-grow: 1;
        }

        .chat-name {
            font-weight: 700;
            font-size: 20px;
            color: #333;
        }

        .chat-email {
            font-size: 14px;
            color: #666;
        }

        .chat-preview {
            font-size: 14px;
            color: #999;
            margin-top: 5px;
            font-style: italic;
        }

        .no-users {
            text-align: center;
            padding: 50px;
            color: #666;
            font-size: 18px;
        }

        .back-btn {
            position: absolute;
            right: 20px;
            top: 20px;
            background-color: transparent;
            color: #fff;
            font-size: 24px;
            border: none;
            cursor: pointer;
        }

        .back-btn:hover {
            color: #ddd;
        }

        .chat-list::-webkit-scrollbar {
            width: 8px;
        }

        .chat-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .chat-list::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 5px;
        }

        .chat-list::-webkit-scrollbar-thumb:hover {
            background: #aaa;
        }

        @media (max-width: 768px) {
            .chat-container {
                width: 90%;
                height: 90vh;
            }

            .chat-list-item {
                padding: 15px;
            }

            .chat-avatar {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .chat-name {
                font-size: 18px;
            }

            .chat-email,
            .chat-preview {
                font-size: 12px;
            }

            .back-btn {
                top: 10px;
                right: 15px;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="chat-container">
    <!-- Header -->
    <div class="chat-header">
        Chat
        <!-- Back Button -->
        <button class="back-btn" onclick="window.location.href='{{ route('mechanic.dashboard') }}'">&times;</button>
    </div>

    @if($users->isEmpty())
        <div class="no-users">No users found!</div>
    @else
        <ul class="chat-list">
            @foreach($users as $user)
                <li class="chat-list-item" onclick="window.location.href='{{ route('mechanic.messages.chat', $user->id) }}'">
                    <div class="chat-avatar">
                        {{ strtoupper(substr($user->first_name, 0, 1)) }}
                    </div>

                    <div class="chat-info">
                        <div class="chat-name">{{ $user->first_name }} {{ $user->last_name }}</div>
                        <div class="chat-email">{{ $user->email }}</div>

                        @if($user->latestMessage)
                            <div class="chat-preview">
                                @if($user->latestMessage->sender_type === 'mechanic')
                                    You:
                                @else
                                    {{ $user->first_name }}:
                                @endif

                                {{ Str::limit($user->latestMessage->message, 40, '...') }}

                                <small class="text-muted"> • {{ $user->latestMessage->created_at->diffForHumans() }}</small>
                            </div>
                        @else
                            <div class="chat-preview text-muted">No messages yet</div>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

</div>

</body>
</html>
