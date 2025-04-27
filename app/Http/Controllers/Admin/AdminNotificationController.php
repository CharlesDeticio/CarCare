<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('admin_id', Auth::guard('admin')->id())
            ->latest()
            ->paginate(10);

        return view('admin.notifications.index', compact('notifications'));
    }

    public function getUnreadCount()
    {
        $count = Notification::where('admin_id', Auth::guard('admin')->id())
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $count]);
    }

    public function markAllAsRead()
    {
        Notification::where('admin_id', Auth::guard('admin')->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $notification = Notification::where('admin_id', Auth::guard('admin')->id())
            ->find($id);

        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function fetch()
{
    $adminId = auth('admin')->id();

    $notifications = Notification::where('admin_id', $adminId)
                        ->latest()
                        ->take(10)
                        ->get();

    $unreadCount = Notification::where('admin_id', $adminId)
                        ->where('is_read', false)
                        ->count();

    return response()->json([
        'notifications' => $notifications,
        'unread_count' => $unreadCount
    ]);
}

}
