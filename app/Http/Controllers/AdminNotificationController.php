<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;

class AdminNotificationController extends Controller
{
    /**
     * Show all notifications for the logged-in admin.
     */
    public function index()
    {
        $adminId = Auth::guard('admin')->id();

        $notifications = Notification::where('admin_id', $adminId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Optional: mark all as read here, or do it via AJAX
        Notification::where('admin_id', $adminId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Return unread notification count for the admin (used for badge).
     */
    public function getUnreadCount()
    {
        $adminId = Auth::guard('admin')->id();

        $unreadCount = Notification::where('admin_id', $adminId)
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }

    /**
     * Mark all admin notifications as read via AJAX.
     */
    public function markAllAsRead()
    {
        $adminId = Auth::guard('admin')->id();

        Notification::where('admin_id', $adminId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete a specific admin notification.
     */
    public function destroy($id)
    {
        $adminId = Auth::guard('admin')->id();

        $notification = Notification::where('admin_id', $adminId)->find($id);

        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found.'], 404);
    }
}
