<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Carcare | Chat List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .chat-container {
            max-width: 900px;
            height: 90vh;
            background-color: #fff;
            margin: 40px auto;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-header {
            background-color: #4F46E5;
            color: #fff;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: #fff;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .chat-list {
            list-style: none;
            margin: 0;
            padding: 0;
            overflow-y: auto;
            flex: 1;
        }

        .chat-list-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
            transition: background 0.2s;
        }

        .chat-list-item:hover {
            background-color: #f9f9f9;
        }

        .chat-avatar {
            position: relative;
            width: 60px;
            height: 60px;
            background-color: #e9ecef;
            color: #495057;
            font-weight: 600;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .status-indicator {
            position: absolute;
            bottom: 4px;
            right: 4px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .status-online {
            background-color: #4CAF50;
        }

        .status-offline {
            background-color: #adb5bd;
        }

        .chat-info {
            flex: 1;
        }

        .chat-name {
            font-weight: 600;
            font-size: 18px;
            color: #333;
        }

        .chat-email {
            font-size: 14px;
            color: #888;
        }

        .recent-message {
            font-size: 14px;
            color: #555;
        }

        .recent-message small {
            color: #aaa;
        }

        .no-mechanics {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 18px;
        }

        .chat-list::-webkit-scrollbar {
            width: 8px;
        }

        .chat-list::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .chat-container {
                margin: 20px;
                height: 95vh;
            }

            .chat-list-item {
                padding: 16px;
            }

            .chat-avatar {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .chat-name {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="chat-container">

        <!-- Header -->
        <div class="chat-header">
            <h2>Chat List</h2>
            <button class="back-btn" onclick="window.location.href='{{ route('dashboard') }}'">
                &times;
            </button>
        </div>

        <!-- No Mechanics -->
        @if($mechanics->isEmpty())
        <div class="no-mechanics">No mechanics available at the moment!</div>
        @else
        <!-- Mechanics Chat List -->
        <ul class="chat-list" id="chatList">
            @foreach($mechanics as $mechanic)
            <li class="chat-list-item" id="mechanic-{{ $mechanic->id }}" onclick="window.location.href='{{ route('user.messages.chat', $mechanic->id) }}'">

                <div class="chat-avatar">
                    {{ strtoupper(substr($mechanic->shopname, 0, 1)) }}
                    <span class="status-indicator {{ $mechanic->is_online ? 'status-online' : 'status-offline' }}"></span>
                </div>

                <div class="chat-info">
                    <div class="chat-name">{{ $mechanic->shopname }}</div>
                    <div class="chat-email">{{ $mechanic->email }}</div>

                    @if($mechanic->latestMessage)
                    <div class="recent-message">
                        <strong>
                            @if($mechanic->latestMessage->sender_type === 'user')
                            You:
                            @else
                            {{ $mechanic->shopname }}:
                            @endif
                        </strong>
                        {{ Str::limit($mechanic->latestMessage->message, 50) }}
                        <br>
                        <small>{{ $mechanic->latestMessage->created_at->diffForHumans() }}</small>
                    </div>
                    @else
                    <div class="recent-message text-muted">No messages yet.</div>
                    @endif
                </div>

            </li>
            @endforeach
        </ul>
        @endif

    </div>

    <!-- Laravel Echo & Pusher Scripts (or Socket.io if you prefer) -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>

    <script>
        // Enable Pusher logging for development (remove in production)
        Pusher.logToConsole = true;

        // Initialize Pusher
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true
        });

        // Listen to new messages
        Echo.private(`user.{{ auth()->user()->id }}`)
            .listen('NewMessage', (e) => {
                console.log('New message received:', e);

                const mechanicId = e.message.mechanic_id;
                const chatItem = document.getElementById(`mechanic-${mechanicId}`);

                if (chatItem) {
                    const chatInfo = chatItem.querySelector('.chat-info');

                    const latestMessage = `
                        <div class="recent-message">
                            <strong>${e.message.sender_type === 'user' ? 'You:' : e.mechanic.shopname + ':'}</strong>
                            ${e.message.message.substring(0, 50)}
                            <br>
                            <small>Just now</small>
                        </div>
                    `;

                    chatInfo.innerHTML = `
                        <div class="chat-name">${e.mechanic.shopname}</div>
                        <div class="chat-email">${e.mechanic.email}</div>
                        ${latestMessage}
                    `;

                    // Optional: move this chat to the top (basic example)
                    const chatList = document.getElementById('chatList');
                    chatList.prepend(chatItem);
                }
            });

        // Listen to online status updates
        Echo.channel('mechanics-status')
            .listen('MechanicStatusUpdated', (e) => {
                const mechanicId = e.mechanic_id;
                const chatItem = document.getElementById(`mechanic-${mechanicId}`);

                if (chatItem) {
                    const statusIndicator = chatItem.querySelector('.status-indicator');
                    if (statusIndicator) {
                        statusIndicator.classList.toggle('status-online', e.is_online);
                        statusIndicator.classList.toggle('status-offline', !e.is_online);
                    }
                }
            });
    </script>

</body>

</html>
