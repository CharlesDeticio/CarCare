<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceRating;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ServiceRatingController extends Controller
{
    /**
     * Store a service rating
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'service_id' => 'required|exists:services,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $booking = Booking::where('id', $request->booking_id)
            ->where('service_id', $request->service_id)
            ->where('user_id', auth()->id())
            ->where('status', 'completed') // ✅ Ensure booking is completed!
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Invalid booking or service.');
        }

        // ✅ Check if already rated PER BOOKING
        $existingRating = ServiceRating::where('booking_id', $request->booking_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingRating) {
            return redirect()->back()->with('error', 'You already rated this booking.');
        }

        $rating = ServiceRating::create([
            'service_id' => $request->service_id,
            'booking_id' => $request->booking_id,
            'user_id'    => auth()->id(),
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        // ✅ Notify the user (confirmation)
        Notification::create([
            'user_id'             => auth()->id(),
            'service_id'          => $request->service_id,
            'booking_id'          => $request->booking_id,
            'service_ratings_id'  => $rating->id,
            'message'             => 'Thank you! Your service rating has been submitted.',
            'is_read'             => false,
        ]);

        // ✅ Notify the mechanic (linked to booking)
        if ($booking->mechanic) {
            Notification::create([
                // 'user_id'             => $booking->mechanic->id,
                'mechanic_id'         => $booking->mechanic->id,
                'service_id'          => $request->service_id,
                'booking_id'          => $request->booking_id,
                'service_ratings_id'  => $rating->id,
                'message'             => 'Your service has been rated by a customer.',
                'is_read'             => false,
            ]);
        }

        return redirect()->route('user.bookings.pending')->with('success', 'Thank you for rating the service!');
    }

    /**
     * Show all ratings for a specific service (Optional for admin or user reviews)
     */
    public function showServiceRatings($serviceId)
    {
        $service = Service::with('ratings.user')->findOrFail($serviceId);

        return view('service.ratings.index', compact('service'));
    }
}
