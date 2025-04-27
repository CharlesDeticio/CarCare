<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Show all notifications and mark them as read
    public function index()
    {
        $userId = Auth::id();

        // Retrieve all notifications (both read and unread)
        $notifications = Notification::where('user_id', $userId)
    ->whereNull('admin_id') // ✅ ensure it's NOT an admin notification
    ->with([
        'product',
        'mechanic',
        'product.mechanic',
        'booking.service',
        'productRating',   
        'service', 
        'serviceRating' 
    ])
    ->orderBy('created_at', 'desc')
    ->paginate(10);


        // Mark all unread notifications as read
        Notification::where('user_id', $userId)
                    ->where('is_read', false) // Only update unread ones
                    ->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }

    // Get unread notifications count for the sidebar
    public function getNotifications()
    {
        $userId = Auth::id();
        $unreadCount = Notification::where('user_id', $userId)
    ->whereNull('admin_id') // ✅ only count user-notifications
    ->where('is_read', false)
    ->count();


        return response()->json(['unread_count' => $unreadCount]);
    }

    // Mark all notifications as read via AJAX
    public function markAllNotificationsAsRead()
    {
        $userId = Auth::id();
        Notification::where('user_id', $userId)
    ->whereNull('admin_id') // ✅ only user-notifications
    ->where('is_read', false)
    ->update(['is_read' => true]);


        return response()->json(['success' => true]);
    }

    // Mark a single notification as read
    public function markAsRead($id)
{
    $notification = Notification::find($id);

    if (!$notification) {
        return response()->json(['success' => false, 'message' => 'Notification not found.'], 404);
    }

    $notification->delete(); // Delete the notification

    return response()->json(['success' => true]);
}

public function destroy($id)
{
    $notification = auth()->user()->notifications()->find($id);

    if ($notification) {
        $notification->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}



}