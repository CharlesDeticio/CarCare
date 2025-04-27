<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingReminder;
use App\Mail\MechanicBookingReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;





class ServiceController extends Controller
{
    public function index()
{
    $mechanic_id = Auth::guard('mechanic')->id();
    $services = Service::where('mechanic_id', $mechanic_id)->get();
    
    return view('mechanic.service.index', compact('services'));
}

    public function shwservice(Request $request)
    {
        $query = Service::where('mechanic_id', Auth::guard('mechanic')->id());

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter functionality
    if ($request->has('filter') && $request->filter != '') {
        $query->orderBy($request->filter);
    }

    $services = $query->get();
    return view('mechanic.dashboard', compact('services'));
    }

   public function add()
   {
        return view('mechanic.service.add');
    }

    public function storage(Request $request)
{
    $mechanic_id = Auth::guard('mechanic')->id();
    if (!$mechanic_id) {
        return redirect()->back()->with('error', 'Mechanic not authenticated.');
    }

    $field = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Initialize the image path variable as null
    $imagePath = null;

    // Check if a file is uploaded
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file_name = time() . $file->getClientOriginalName();
        $file->move(public_path('upload'), $file_name);
        $imagePath = $file_name; // Set the image path
    }

    $field['image'] = $imagePath; // Assign the image path
    $field['name'] = strip_tags($field['name']);
    $field['description'] = strip_tags($field['description']);
    $field['price'] = strip_tags($field['price']);
    $field['mechanic_id'] = $mechanic_id; // Assign the mechanic_id

    Service::create($field);

    return redirect()->route('mechanic.dashboard')->with('success', 'Service created successfully.');
}
    public function shows(Service $service)
    {
        if ($service->mechanic_id !== Auth::guard('mechanic')->id()) {
                abort(403, 'Unauthorized action.');
        }
        return view('mechanic.service.show', compact('service'));
    }

    public function edit(Service $service)
    {
        if ($service->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
    }
        return view('mechanic.service.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
{
    // Check mechanic ownership
    if ($service->mechanic_id !== Auth::guard('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Validate inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $updateData = [
        'name' => strip_tags($request->input('name')),
        'description' => strip_tags($request->input('description')),
        'price' => strip_tags($request->input('price')),
    ];

    // Check if a new image was uploaded
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload'), $file_name);

        // Optional: Delete old image
        if ($service->image && file_exists(public_path('upload/' . $service->image))) {
            unlink(public_path('upload/' . $service->image));
        }

        // Add the new image to the update data
        $updateData['image'] = $file_name;
    }

    // Update service data
    $service->update($updateData);

    return redirect()->route('mechanic.dashboard')->with('success', 'Service updated successfully.');
}


    public function destroys(Service $service)
    {
        $service->delete();
        
        return redirect()->route('mechanic.dashboard')->with('success', 'Service deleted successfully.');
    }

//     public function show(Service $service)
// {
//     return view('user.serviceshow', compact('service'));
// }

// app/Http/Controllers/ServiceController.php


public function viewBookings(Request $request)
{
    $mechanic_id = Auth::guard('mechanic')->id();

    $query = Booking::where('mechanic_id', $mechanic_id)
        ->with(['service', 'user.cars']);

    if ($request->filled('month')) {
        $query->whereMonth('booking_date', $request->month);
    }

    if ($request->filled('day')) {
        $query->whereDay('booking_date', $request->day);
    }

    $bookings = $query->orderBy('booking_date', 'asc')->get();

    $pendingBookings = $bookings->where('status', 'pending');
    $acceptedBookings = $bookings->where('status', 'accepted');
    $completedBookings = $bookings->where('status', 'completed');
    $declinedBookings = $bookings->where('status', 'declined');

    // Get available remaining months from all mechanic's bookings
    $availableMonths = Booking::where('mechanic_id', $mechanic_id)
        ->whereMonth('booking_date', '>=', now()->month)
        ->selectRaw('MONTH(booking_date) as month')
        ->distinct()
        ->orderBy('month')
        ->pluck('month')
        ->mapWithKeys(fn($m) => [$m => Carbon::create()->month($m)->format('F')]);

    // Get available days based on selected month (if any)
    $bookingDaysQuery = Booking::where('mechanic_id', $mechanic_id);
    if ($request->filled('month')) {
        $bookingDaysQuery->whereMonth('booking_date', $request->month);
    }

    $bookingDays = $bookingDaysQuery
        ->selectRaw('DAY(booking_date) as day')
        ->distinct()
        ->orderBy('day')
        ->pluck('day');

    $cancellationReasons = [
        'Customer No Show',
        'Mechanic Unavailable',
        'Incorrect Booking Details',
        'Other',
    ];

    return view('mechanic.bookings.index', compact(
        'pendingBookings',
        'acceptedBookings',
        'completedBookings',
        'declinedBookings',
        'cancellationReasons',
        'availableMonths',
        'bookingDays'
    ));
}

public function acceptBooking(Booking $booking)
{
    if ($booking->mechanic_id !== Auth::guard('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    $booking->update([
        'status' => 'accepted',
        'status_msg' => 'Your booking has been accepted by the mechanic.',
    ]);

    $service = $booking->service;

    // ✅ Send User Notification
    Notification::create([
        'user_id' => $booking->user_id,
        'mechanic_id' => null,
        'service_id'  => $booking->service_id,
        'message' => 'Your booking has been accepted by the mechanic.',
        'is_read' => false,
    ]);

    // ✅ Send Mechanic Notification
    Notification::create([
        'user_id' => null,
        'mechanic_id' => $booking->mechanic_id,
        'service_id'  => $booking->service_id,
        'message' => 'You have accepted a booking. Prepare for the scheduled service.',
        'is_read' => false,
    ]);

    // ✅ Schedule email reminder to user - 1 minute before the booking time
    $user = $booking->user;
    $bookingDateTime = Carbon::parse($booking->booking_date . ' ' . $booking->booking_time);
    $reminderTime = $bookingDateTime->copy()->subMinute();

    Mail::to($user->email)->send(new BookingReminder($user, $service, $booking));

    // ✅ Send mechanic-specific email
$mechanic = $booking->mechanic;
Mail::to($mechanic->email)->send(new MechanicBookingReminder($mechanic, $service, $booking));
    // if ($reminderTime->isFuture()) {
    //     Mail::to($user->email)->later($reminderTime, new BookingReminder($user, $service, $booking));
    // } else {
    //     Mail::to($user->email)->send(new BookingReminder($user, $service, $booking));
    // }

    return redirect()->route('mechanic.bookings')->with('success', 'Booking accepted successfully.');
}



public function cancelBooking(Request $request, Booking $booking)
{
    if ($booking->mechanic_id !== Auth::guard('mechanic')->id()) {
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

    // Send User Notification
    Notification::create([
        'user_id' => $booking->user_id,
        'mechanic_id' => null,
        'service_id' => $booking->service_id, // ✅ Include this!
        'message' => 'Your booking has been cancelled. Reason: ' . $request->reason,
        'is_read' => false,
    ]);

    // Send Mechanic Notification
    Notification::create([
        'user_id' => null,
        'mechanic_id' => $booking->mechanic_id,
        'service_id'  => $booking->service_id, // or $service->id
        'message' => 'You cancelled a booking. Reason: ' . $request->reason,
        'is_read' => false,
    ]);

    return redirect()->route('mechanic.bookings')->with('success', 'Booking cancelled successfully.');
}


public function completeBooking(Booking $booking)
{
    if ($booking->mechanic_id !== Auth::guard('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    if ($booking->status !== 'accepted') {
        return redirect()->back()->with('error', 'Only accepted bookings can be marked as completed.');
    }

    $booking->update([
        'status' => 'completed',
        'status_msg' => 'Booking completed successfully.',
    ]);

    // Send User Notification
    Notification::create([
        'user_id' => $booking->user_id,
        'mechanic_id' => null,
        'service_id' => $booking->service_id, // ✅ Include this!
        'message' => 'Your booking has been marked as completed. Thank you for choosing us!',
        'is_read' => false,
    ]);

    // Send Mechanic Notification
    Notification::create([
        'user_id' => null,
        'mechanic_id' => $booking->mechanic_id,
        'service_id'  => $booking->service_id, // or $service->id
        'message' => 'You have successfully completed a booking. Great job!',
        'is_read' => false,
    ]);

    return redirect()->route('mechanic.bookings')->with('success', 'Booking marked as completed successfully.');
}



public function showBooking(Booking $booking)
{
    if ($booking->mechanic_id !== Auth::guard('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Eager load relationships for user and cars
    $booking->load([
        'service',
        'user.cars'
    ]);

    // ✅ Define the reasons here!
    $cancellationReasons = [
        'Customer No Show',
        'Mechanic Unavailable',
        'Incorrect Booking Details',
        'Other'
    ];

    return view('mechanic.bookings.show', compact('booking', 'cancellationReasons'));
}


public function showy(Service $service)
{
    // Get all ratings for this service, with the user info
    $serviceRatings = \App\Models\ServiceRating::where('service_id', $service->id)
        ->with('user') // eager load user info for display
        ->latest()
        ->get();

    // Calculate the average rating for this service
    $averageRating = \App\Models\ServiceRating::where('service_id', $service->id)
        ->avg('rating');

    // Pass service, ratings, and average rating to the view
    return view('user.service-details', compact('service', 'serviceRatings', 'averageRating'));
}

public function didNotArrive(Request $request, Booking $booking)
{
    if ($booking->mechanic_id !== Auth::guard('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'reason' => 'required|string|max:255',
    ]);

    $booking->update([
        'status' => 'cancelled',
        'status_msg' => 'Booking cancelled due to customer not arriving. Reason: ' . $request->reason,
        'reason' => $request->reason,
    ]);

    // Notify user
    Notification::create([
        'user_id' => $booking->user_id,
        'mechanic_id' => null,
        'service_id' => $booking->service_id,
        'message' => 'Your booking was marked as no-show and cancelled by the mechanic. Reason: ' . $request->reason,
        'is_read' => false,
    ]);

    // Notify mechanic
    Notification::create([
        'user_id' => null,
        'mechanic_id' => $booking->mechanic_id,
        'service_id' => $booking->service_id,
        'message' => 'You marked a booking as "Did Not Arrive".',
        'is_read' => false,
    ]);

    return redirect()->route('mechanic.bookings')->with('success', 'Booking marked as "Did Not Arrive" and cancelled.');
}

public function downloadReceipt(Booking $booking)
{
    // Check authorization
    if ($booking->mechanic_id !== Auth::guard('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Only allow download for completed bookings
    if ($booking->status !== 'completed') {
        abort(403, 'Receipt is only available for completed bookings.');
    }

    // Load relationships
    $booking->load(['user', 'service', 'user.cars']);

    // Generate PDF
    $pdf = PDF::loadView('mechanic.bookings.receipt', [
        'booking' => $booking,
        'date' => now()->format('Y-m-d H:i:s')
    ]);

    // Set filename
    $filename = 'receipt-' . $booking->id . '.pdf';

    // Download the PDF
    return $pdf->download($filename);
}

    
}
