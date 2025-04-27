<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyBooking;
use App\Models\User;
use App\Models\Mechanic;
use App\Models\Notification; // ✅ ADD THIS LINE
use Illuminate\Support\Facades\Auth;

class EmergencyBookingController extends Controller
{
    /**
     * Store a new emergency booking.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'emergency_reason' => 'required|string',
        'emergency_address' => 'required|string',
    ]);

    // Get the authenticated user
    $user = Auth::user();

    // Create the emergency booking
    $emergencyBooking = EmergencyBooking::create([
        'user_id' => $user->id,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'emergency_reason' => $request->emergency_reason,
        'emergency_address' => $request->emergency_address,
        'status' => 'pending', // Default status
    ]);

    // ✅ Send notification to the user (confirmation)
    Notification::create([
        'user_id' => $user->id,
        'message' => 'Your emergency booking has been created!',
        'type' => 'emergency_booking',
        'is_read' => false,
    ]);

    // ✅ Send notification to all mechanics
        $mechanics = Mechanic::all();

    foreach ($mechanics as $mechanic) {
        Notification::create([
            'mechanic_id' => $mechanic->id,
            'message' => 'New emergency booking available!',
            'type' => 'emergency_booking',
            'is_read' => false,
        ]);
    }

    // ✅ Optional: Real-time notifications via events or pusher (future step)

    return response()->json([
        'message' => 'Emergency booking created successfully!',
        'data' => $emergencyBooking,
    ], 201);
}


    /**
     * Get all emergency bookings for mechanics to view on the map.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
{
    $mechanic = Auth::guard('mechanic')->user();

    if (!$mechanic) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }

    $emergencyBookings = EmergencyBooking::with('user')
        ->where(function ($query) use ($mechanic) {
            $query->where('status', 'pending')
                ->orWhere(function ($subQuery) use ($mechanic) {
                    $subQuery->where('status', 'accepted')
                             ->where('mechanic_id', $mechanic->id);
                });
        })
        ->get();

    return response()->json([
        'message' => 'Emergency bookings retrieved successfully!',
        'data' => $emergencyBookings,
    ]);
}



    /**
     * Assign a mechanic to an emergency booking.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignMechanic(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'mechanic_id' => 'required|exists:mechanics,id',
        ]);

        // Find the emergency booking
        $emergencyBooking = EmergencyBooking::findOrFail($id);

        // Assign the mechanic to the booking
        $emergencyBooking->update([
            'mechanic_id' => $request->mechanic_id,
            'status' => 'accepted', // Update status to accepted
        ]);

        // Return the updated booking as JSON response
        return response()->json([
            'message' => 'Mechanic assigned successfully!',
            'data' => $emergencyBooking,
        ]);
    }

    /**
     * Accept an emergency booking by a mechanic.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptBooking(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'mechanic_id' => 'required|exists:mechanics,id',
        ]);

        // Find the emergency booking
        $emergencyBooking = EmergencyBooking::findOrFail($id);

        // Check if the booking is already accepted
        if ($emergencyBooking->status === 'accepted') {
            return response()->json([
                'message' => 'This booking has already been accepted by another mechanic.',
            ], 400);
        }

        // Assign the mechanic to the booking
        $emergencyBooking->update([
            'mechanic_id' => $request->mechanic_id,
            'status' => 'accepted', // Update status to accepted
        ]);

        // Return the updated booking as JSON response
        return response()->json([
            'message' => 'Booking accepted successfully!',
            'data' => $emergencyBooking,
        ]);
    }

    public function userBookings()
{
    $user = Auth::user();

    $bookings = EmergencyBooking::with(['mechanic'])
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user-emergency-booking-status', compact('bookings'));
}

public function mechanicBookings()
{
    $mechanic = Auth::guard('mechanic')->user();

    if (!$mechanic) {
        return redirect()->route('mechanic.login'); // Redirect to mechanic login
    }
    
    $bookings = EmergencyBooking::with('user')
        ->where('mechanic_id', $mechanic->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('mechanic-emergency-booking-status', compact('bookings'));
}

public function completeBooking($id)
{
    // Find the booking
    $booking = EmergencyBooking::find($id);

    if (!$booking) {
        return response()->json([
            'message' => 'Emergency booking not found.'
        ], 404);
    }

    // Check if it's already completed
    if ($booking->status === 'completed') {
        return response()->json([
            'message' => 'This booking is already completed.'
        ], 400);
    }

    // Update booking status to completed
    $booking->status = 'completed';
    $booking->save();

    return response()->json([
        'message' => 'Booking marked as completed successfully!',
        'data' => $booking
    ]);
}

public function show($id)
{
    $booking = EmergencyBooking::with('user', 'mechanic')->findOrFail($id);

    return view('mechanic.emergency-bookings.show', compact('booking'));
}

public function showUser($id)
{
    $booking = EmergencyBooking::with('user', 'mechanic')->findOrFail($id);
    return view('user-emergency-bookings.show', compact('booking'));
}




}