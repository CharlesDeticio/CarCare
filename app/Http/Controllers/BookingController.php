<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use App\Models\ServiceRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingReminder;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class BookingController extends Controller
{
    public function create(Service $service)
    {
        return view('user.bookings.create', compact('service'));
    }

    public function store(Request $request, Service $service)
{
    $request->validate([
        'booking_date' => 'required|date|after_or_equal:today',
        'booking_time' => 'required|date_format:H:i',
        'reason' => 'nullable|string',
    ]);

    // Check if the current user already has a booking for this service at the same date/time
    $existingUserBooking = Booking::where('service_id', $service->id)
        ->where('user_id', auth()->id())
        ->where('booking_date', $request->booking_date)
        ->where('booking_time', $request->booking_time)
        ->whereIn('status', ['pending', 'accepted'])
        ->first();

    if ($existingUserBooking) {
        return back()->withInput()
            ->with('error', 'You already have a booking for this service at the selected time. Please choose a different time or date.');
    }
    
    // Optional: Check mechanic's maximum concurrent bookings capacity
    // $currentBookingsCount = Booking::where('mechanic_id', $service->mechanic_id)
    //     ->where('booking_date', $request->booking_date)
    //     ->where('booking_time', $request->booking_time)
    //     ->whereIn('status', ['pending', 'accepted'])
    //     ->count();

    // Example: If mechanic can only handle 3 bookings at the same time
    $maxCapacity = 3; // You can make this dynamic from mechanic's profile
    // if ($currentBookingsCount >= $maxCapacity) {
    //     return back()->withInput()
    //         ->with('error', 'This time slot is fully booked. Please choose another time.');
    // }

    // Create booking
    $booking = Booking::create([
        'booking_date' => $request->input('booking_date'),
        'booking_time' => $request->input('booking_time'),
        'reason' => $request->input('reason'),
        'service_id' => $service->id,
        'mechanic_id' => $service->mechanic_id,
        'user_id' => auth()->id(),
        'status' => 'pending',
        'status_msg' => 'Booking is pending for approval.',
    ]);

    $mechanic = $service->mechanic;

    // Send notification to user
    \App\Models\Notification::create([
        'user_id' => $booking->user_id,
        'mechanic_id' => null,
        'service_id' => $booking->service_id,
        'message' => 'Your booking request has been received and is awaiting mechanic approval from ' . ($mechanic->shopname ?? 'the mechanic') . '.',
        'is_read' => false,
    ]);

    // Send notification to mechanic
    \App\Models\Notification::create([
        'user_id' => null,
        'mechanic_id' => $booking->mechanic_id,
        'service_id' => $booking->service_id,
        'message' => 'You have a new booking request that requires your attention.',
        'is_read' => false,
    ]);

    return redirect()->route('user.bookings.pending')->with('success', 'Booking created successfully.');
}

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('service')
            ->orderBy('booking_date', 'desc')
            ->latest()
            ->get();

        $cancellationReasons = [
            'Change of plans',
            'Found another service',
            'Scheduling conflict',
            'Other',
        ];

        return view('user.bookings.index', compact('bookings', 'cancellationReasons'));
    }

    public function show(Booking $booking)
{
    if ($booking->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $booking->load('service');

    $hasRated = ServiceRating::where('booking_id', $booking->id)
        ->where('user_id', auth()->id())
        ->exists();
        
    return view('user.bookings.show', compact('booking', 'hasRated'));
}



    public function pending()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->with('service.mechanic')
->orderBy('booking_date', 'asc')
    ->orderBy('booking_time', 'asc')            ->get();

        $cancellationReasons = [
            'Change of plans',
            'Found another service',
            'Scheduling conflict',
            'Other',
        ];

        return view('user.bookings.pending', compact('bookings', 'cancellationReasons'));
    }

    public function accepted()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->where('status', 'accepted')
            ->with('service.mechanic') // Add mechanic relationship here!
->orderBy('booking_date', 'asc')
    ->orderBy('booking_time', 'asc')            ->get();

        // Add or update status_msg dynamically if not already present
        foreach ($bookings as $booking) {
            if (empty($booking->status_msg)) {
                $booking->status_msg = 'Please bring your car here in this address.';
            }
        }

        return view('user.bookings.accepted', compact('bookings'));
    }

    public function completed()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->with('service.mechanic')
->orderBy('booking_date', 'asc')
    ->orderBy('booking_time', 'asc')            ->get();

        foreach ($bookings as $booking) {
            if (empty($booking->status_msg)) {
                $booking->status_msg = 'Booking completed.';
            }
        }

        return view('user.bookings.completed', compact('bookings'));
    }

    public function cancel(Request $request, Booking $booking)
{
    if ($booking->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'reason' => 'required|string|max:255',
    ]);

    $booking->update([
        'status' => 'cancelled',
        'status_msg' => 'Booking cancelled. Reason: ' . $request->reason,
        'reason' => $request->reason,
    ]);

    // ✅ Send notification to the mechanic about cancellation
    \App\Models\Notification::create([
        'user_id' => null, // because the notification is for mechanic
        'mechanic_id' => $booking->mechanic_id,
        'service_id' => $booking->service_id,
        'message' => 'A user has cancelled their booking for the service: ' . ($booking->service->name ?? 'Unknown Service') . '.',
        'is_read' => false,
    ]);

    \App\Models\Notification::create([
        'user_id' => $booking->user_id,
        'mechanic_id' => null,
        'service_id' => $booking->service_id,
        'message' => 'You have cancelled your booking for the service: ' . ($booking->service->name ?? 'Unknown Service') . '.',
        'is_read' => false,
    ]);

    return redirect()->route('user.bookings.cancelled.list')->with('success', 'Booking cancelled successfully.');
}


    public function cancelledList()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->where('status', 'cancelled')
            ->with('service.mechanic')
->orderBy('booking_date', 'asc')
    ->orderBy('booking_time', 'asc')            ->get();

        foreach ($bookings as $booking) {
            if (empty($booking->status_msg)) {
                $booking->status_msg = 'Booking cancelled.';
            }
        }

        return view('user.bookings.cancelled', compact('bookings'));
    }

    public function rateService(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'booking_id' => 'required|exists:bookings,id',
        'rating'     => 'required|integer|min:1|max:5',
        'comment'    => 'nullable|string|max:500',
    ]);

    $booking = Booking::where('id', $request->booking_id)
        ->where('service_id', $request->service_id)
        ->where('user_id', auth()->id())
        ->where('status', 'completed')
        ->first();

    if (!$booking) {
        return redirect()->back()->with('error', 'Booking not found or not eligible for rating.');
    }

    $existingRating = ServiceRating::where('service_id', $request->service_id)
        ->where('user_id', auth()->id())
        ->where('booking_id', $request->booking_id)
        ->first();

    if ($existingRating) {
        return redirect()->back()->with('error', 'You have already rated this booking.');
    }

    $rating = ServiceRating::create([
        'service_id' => $request->service_id,
        'booking_id' => $request->booking_id,
        'user_id'    => auth()->id(),
        'rating'     => $request->rating,
        'comment'    => $request->comment,
    ]);

    $service = Service::find($request->service_id);
    $mechanic = $service?->mechanic;

    // ✅ Notify the user (confirmation)
    \App\Models\Notification::create([
        'user_id'            => auth()->id(),
        'service_id'         => $service->id,
        'service_rating_id'  => $rating->id,
        'message'            => 'Your service review has been submitted successfully.',
        'is_read'            => false,
    ]);

    // ✅ Notify the mechanic (silent message)
    if ($mechanic) {
        \App\Models\Notification::create([
            // 'user_id'            => $mechanic->id,
            'mechanic_id'        => $mechanic->id,
            'service_id'         => $service->id,
            'service_rating_id'  => $rating->id,
            'message'            => 'Your service has received a new rating.',
            'is_read'            => false,
        ]);
    }

    return redirect()->back()->with('success', 'Thank you for rating the service!');
}

public function downloadReceipt(Booking $booking)
{
    // Check authorization
    if ($booking->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Only allow download for completed bookings
    if ($booking->status !== 'completed') {
        abort(403, 'Receipt is only available for completed bookings.');
    }

    // Load relationships
    $booking->load(['service', 'service.mechanic', 'user']);

    // Generate PDF
    $pdf = PDF::loadView('user.bookings.receipt', [
        'booking' => $booking,
        'date' => now()->format('Y-m-d H:i:s')
    ]);

    // Set filename
    $filename = 'receipt-' . $booking->id . '.pdf';

    // Download the PDF
    return $pdf->download($filename);
}

}
