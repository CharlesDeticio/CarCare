<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /*===============================================
    =            USER MESSAGE HANDLING             =
    ===============================================*/

    // ✅ User Chat List
    public function userChatList()
{
    $userId = Auth::id();

    $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)->where('sender_type', 'user');
        })
        ->orWhere(function ($query) use ($userId) {
            $query->where('receiver_id', $userId)->where('receiver_type', 'user');
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $latestMechanicMessages = [];

    foreach ($messages as $message) {
        if ($message->sender_type === 'mechanic') {
            $partnerId = $message->sender_id;
        } elseif ($message->receiver_type === 'mechanic') {
            $partnerId = $message->receiver_id;
        } else {
            continue;
        }

        if (!isset($latestMechanicMessages[$partnerId])) {
            $latestMechanicMessages[$partnerId] = $message->created_at;
        }
    }

    arsort($latestMechanicMessages);

    $sortedMechanicIds = array_keys($latestMechanicMessages);

    $mechanics = Mechanic::whereIn('id', $sortedMechanicIds)->get();

    $partners = $mechanics->sortBy(function ($mechanic) use ($sortedMechanicIds) {
        return array_search($mechanic->id, $sortedMechanicIds);
    })->map(function ($mechanic) use ($messages) {

        // Get the latest message with this mechanic
        $latestMessage = $messages->first(function ($message) use ($mechanic) {
            return ($message->sender_type === 'mechanic' && $message->sender_id === $mechanic->id)
                || ($message->receiver_type === 'mechanic' && $message->receiver_id === $mechanic->id);
        });

        // Add latest message to the mechanic model
        $mechanic->latestMessage = $latestMessage;

        return $mechanic;
    });

    return view('messages.user_chat_list', [
        'mechanics' => $partners
    ]);
}



    // ✅ User Chat with a specific Mechanic
    public function userChat($receiverId)
{
    $userId = Auth::id(); // Logged-in user ID

    // Get the mechanic user wants to chat with
    $receiver = Mechanic::findOrFail($receiverId);

    // Only fetch messages between THIS user and THIS mechanic
    $messages = Message::where(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)
                  ->where('sender_type', 'user')
                  ->where('receiver_id', $receiverId)
                  ->where('receiver_type', 'mechanic');
        })
        ->orWhere(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('sender_type', 'mechanic')
                  ->where('receiver_id', $userId)
                  ->where('receiver_type', 'user');
        })
        ->orderBy('created_at', 'asc')
        ->get();

    return view('messages.user_chat', compact('messages', 'receiver'));
}


    // ✅ Send Message from User to Mechanic
    public function userSend(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'receiver_id' => 'required|numeric|exists:mechanics,id',
            'message'     => 'required|string'
        ]);

        Message::create([
            'sender_id'     => $userId,
            'receiver_id'   => $request->receiver_id,
            'sender_type'   => 'user',
            'receiver_type' => 'mechanic',
            'message'       => $request->message,
            'is_read'       => 0,
        ]);

        return redirect()->back()->with('success', 'Message sent!');
    }

    // ✅ Mark ALL Chats As Read for User
    public function userMarkChatAsRead()
    {
        $userId = auth()->id();

        Message::where('receiver_id', $userId)
            ->where('receiver_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /*===============================================
    =            MECHANIC MESSAGE HANDLING         =
    ===============================================*/

    // ✅ Mechanic Chat List
    public function mechanicChatList()
{
    $mechanicId = auth()->guard('mechanic')->id();

    $messages = Message::where(function ($query) use ($mechanicId) {
            $query->where('sender_id', $mechanicId)->where('sender_type', 'mechanic');
        })
        ->orWhere(function ($query) use ($mechanicId) {
            $query->where('receiver_id', $mechanicId)->where('receiver_type', 'mechanic');
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $latestUserMessages = [];

    // Group messages by user and keep the latest message
    foreach ($messages as $message) {
        if ($message->sender_type === 'user') {
            $partnerId = $message->sender_id;
        } elseif ($message->receiver_type === 'user') {
            $partnerId = $message->receiver_id;
        } else {
            continue;
        }

        // Save only the latest message for each user
        if (!isset($latestUserMessages[$partnerId])) {
            $latestUserMessages[$partnerId] = $message;
        }
    }

    // Get user IDs from the latest message array
    $sortedUserIds = array_keys($latestUserMessages);

    // Fetch users in that sorted order
    $users = User::whereIn('id', $sortedUserIds)->get()->sortBy(function ($user) use ($sortedUserIds) {
        return array_search($user->id, $sortedUserIds);
    })->map(function ($user) use ($latestUserMessages) {
        $user->latestMessage = $latestUserMessages[$user->id];
        return $user;
    });

    return view('mechanic.messages.chat_list', compact('users'));
}



    // ✅ Mechanic Chat with a Specific User
    public function mechanicChat($receiverId)
    {
        $mechanicId = auth()->guard('mechanic')->id();

        $receiver = User::findOrFail($receiverId);

        $messages = Message::where(function ($query) use ($mechanicId, $receiverId) {
                $query->where('sender_id', $mechanicId)
                      ->where('sender_type', 'mechanic')
                      ->where('receiver_id', $receiverId)
                      ->where('receiver_type', 'user');
            })->orWhere(function ($query) use ($mechanicId, $receiverId) {
                $query->where('sender_id', $receiverId)
                      ->where('sender_type', 'user')
                      ->where('receiver_id', $mechanicId)
                      ->where('receiver_type', 'mechanic');
            })->orderBy('created_at', 'asc')->get();

        return view('mechanic.messages.chat', compact('receiver', 'messages'));
    }

    // ✅ Send Message from Mechanic to User
    public function mechanicSend(Request $request)
    {
        $mechanicId = auth()->guard('mechanic')->id();

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message'     => 'required|string'
        ]);

        Message::create([
            'sender_id'     => $mechanicId,
            'sender_type'   => 'mechanic',
            'receiver_id'   => $request->receiver_id,
            'receiver_type' => 'user',
            'message'       => $request->message,
            'is_read'       => 0,
        ]);

        return redirect()->back()->with('success', 'Message sent!');
    }

    /*===============================================
    =            API ENDPOINTS                      =
    ===============================================*/

    // ✅ User Unread Chat Notifications Count
    public function userChatNotifications()
    {
        $userId = auth()->id();

        $unreadCount = Message::where('receiver_id', $userId)
            ->where('receiver_type', 'user')
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }

    // ✅ Mechanic Unread Chat Notifications Count
    public function mechanicChatNotifications()
    {
        $mechanicId = auth()->guard('mechanic')->id();

        $unreadCount = Message::where('receiver_id', $mechanicId)
            ->where('receiver_type', 'mechanic')
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }

    // ✅ Mechanic Mark ALL Chats As Read
    public function mechanicMarkAllChatsAsRead()
    {
        $mechanicId = auth()->guard('mechanic')->id();

        Message::where('receiver_id', $mechanicId)
            ->where('receiver_type', 'mechanic')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    // ✅ Mechanic Mark Chats From A Specific User As Read (Optional)
    // public function mechanicMarkUserChatsAsRead(Request $request)
    // {
    //     $mechanicId = auth()->guard('mechanic')->id();
    //     $userId = $request->input('user_id');

    //     Message::where('sender_id', $userId)
    //         ->where('sender_type', 'user')
    //         ->where('receiver_id', $mechanicId)
    //         ->where('receiver_type', 'mechanic')
    //         ->where('is_read', false)
    //         ->update(['is_read' => true]);

    //     return response()->json(['success' => true]);
    // }

    public function mechanicMarkChatAsRead()
{
    $mechanicId = auth()->guard('mechanic')->id();

    // Mark ALL messages sent to the mechanic as read
    Message::where('receiver_id', $mechanicId)
        ->where('receiver_type', 'mechanic')
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

// public function userMarkChatAsRead()
//     {
//         $userId = auth()->id();

//         Message::where('receiver_id', $userId)
//             ->where('receiver_type', 'user')
//             ->where('is_read', false)
//             ->update(['is_read' => true]);

//         return response()->json(['success' => true]);
//     }

}