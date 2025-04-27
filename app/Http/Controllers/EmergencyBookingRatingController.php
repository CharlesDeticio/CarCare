<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyBooking;
use App\Models\EmergencyBookingRating;
use Illuminate\Support\Facades\Auth;

class EmergencyBookingRatingController extends Controller
{
    public function store(Request $request, EmergencyBooking $booking)
    {
        // Verify the booking belongs to the user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Verify the booking is completed
        if ($booking->status !== 'completed') {
            return back()->with('error', 'You can only rate completed services.');
        }

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check for existing rating using the singular relationship
        if ($booking->rating) {
            return back()->with('error', 'You have already rated this emergency service.');
        }

        // Create the rating
        EmergencyBookingRating::create([
            'emergency_booking_id' => $booking->id,
            'user_id'             => Auth::id(),
            'mechanic_id'          => $booking->mechanic_id,
            'rating'               => $request->rating,
            'comment'              => $request->comment,
        ]);

        return back()->with('success', 'Thank you for rating this emergency service!');
    }
}