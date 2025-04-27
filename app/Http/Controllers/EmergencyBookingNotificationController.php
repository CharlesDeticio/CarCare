<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyBooking;
use App\Models\Notification;
use App\Models\Mechanic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmergencyBookingNotificationController extends Controller
{
    /**
     * User Notifications for Emergency Bookings
     */
    public function userNotifications()
    {
        $userId = Auth::id();

        $notifications = Notification::where('user_id', $userId)
            ->where('type', 'emergency_booking')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        Notification::where('user_id', $userId)
            ->where('type', 'emergency_booking')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('notifications.user-emergency-bookings', compact('notifications'));
    }

    /**
     * Mechanic Notifications for Emergency Bookings
     */
    public function mechanicNotifications()
    {
        $mechanicId = Auth::guard('mechanic')->id();

        if (!$mechanicId) {
            return redirect()->route('mechanic.login');
        }

        $notifications = Notification::where('mechanic_id', $mechanicId)
            ->where('type', 'emergency_booking')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        Notification::where('mechanic_id', $mechanicId)
            ->where('type', 'emergency_booking')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('notifications.mechanic-emergency-bookings', compact('notifications'));
    }

    /**
     * Get unread notification count for user.
     */
    public function getUserUnreadCount()
    {
        $userId = Auth::id();

        $count = Notification::where('user_id', $userId)
            ->where('type', 'emergency_booking')
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $count]);
    }

    /**
     * Get unread notification count for mechanic.
     */
    public function getMechanicUnreadCount()
    {
        $mechanicId = Auth::guard('mechanic')->id();

        $count = Notification::where('mechanic_id', $mechanicId)
            ->where('type', 'emergency_booking')
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $count]);
    }

    /**
     * Mark a single emergency notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification not found.'], 404);
        }

        $notification->is_read = true;
        $notification->save();

        return response()->json(['success' => true]);
    }

    /**
     * Delete a notification.
     */
    public function deleteNotification($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification not found.'], 404);
        }

        $notification->delete();

        return response()->json(['success' => true, 'message' => 'Notification deleted successfully.']);
    }

    /**
     * Mark all notifications as read for the current user or mechanic.
     */
    public function markAllAsRead()
    {
        $userId = Auth::id();
        $mechanicId = Auth::guard('mechanic')->id();

        if ($userId) {
            Notification::where('user_id', $userId)
                ->where('type', 'emergency_booking')
                ->update(['is_read' => true]);
        }

        if ($mechanicId) {
            Notification::where('mechanic_id', $mechanicId)
                ->where('type', 'emergency_booking')
                ->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Create an emergency booking and notify both user and mechanics.
     */
    public function createEmergencyBooking(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'emergency_reason' => 'required|string',
            'emergency_address' => 'required|string',
        ]);

        $user = Auth::user();

        $booking = EmergencyBooking::create([
            'user_id' => $user->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'emergency_reason' => $request->emergency_reason,
            'emergency_address' => $request->emergency_address,
            'status' => 'pending',
        ]);

        // Notify the user
        Notification::create([
            'user_id' => $user->id,
            'message' => 'Your emergency booking has been created!',
            'type' => 'emergency_booking',
            'is_read' => false,
        ]);

        // Notify all mechanics (or filter mechanics if you want)
        $mechanics = Mechanic::all();

        foreach ($mechanics as $mechanic) {
            Notification::create([
                'mechanic_id' => $mechanic->id,
                'message' => 'New emergency booking available!',
                'type' => 'emergency_booking',
                'is_read' => false,
            ]);
        }

        return response()->json([
            'message' => 'Emergency booking created successfully!',
            'data' => $booking,
        ]);
    }

    /**
     * Mechanic accepts an emergency booking.
     */
    public function mechanicAcceptBooking(Request $request, $id)
    {
        $mechanic = Auth::guard('mechanic')->user();

        if (!$mechanic) {
            return response()->json(['message' => 'Mechanic not authenticated.'], 401);
        }

        $booking = EmergencyBooking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found.'], 404);
        }

        if ($booking->status === 'accepted') {
            return response()->json(['message' => 'Booking already accepted.'], 400);
        }

        $booking->update([
            'mechanic_id' => $mechanic->id,
            'status' => 'accepted',
        ]);

        // Notify the user that their booking was accepted
        Notification::create([
            'user_id' => $booking->user_id,
            'message' => 'Your emergency booking has been accepted by ' . $mechanic->shopname . '!',
            'type' => 'emergency_booking',
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Booking accepted successfully!',
            'data' => $booking,
        ]);
    }

    /**
     * Mechanic completes an emergency booking.
     */
    public function mechanicCompleteBooking(Request $request, $id)
    {
        $mechanic = Auth::guard('mechanic')->user();

        if (!$mechanic) {
            return response()->json(['message' => 'Mechanic not authenticated.'], 401);
        }

        $booking = EmergencyBooking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found.'], 404);
        }

        if ($booking->status === 'completed') {
            return response()->json(['message' => 'Booking already completed.'], 400);
        }

        $booking->update([
            'status' => 'completed',
        ]);

        // Notify the user that their booking was completed
        Notification::create([
            'user_id' => $booking->user_id,
            'message' => 'Your emergency booking has been marked as completed by ' . $mechanic->shopname . '!',
            'type' => 'emergency_booking',
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Booking marked as completed!',
            'data' => $booking,
        ]);
    }
}
