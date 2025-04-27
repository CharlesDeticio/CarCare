<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Order;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Admin;
use App\Models\EmergencyBookingRating;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\SendOTPNotification;



class MechanicController extends Controller
{
    public function index()
{
    $mechanic = Auth::guard('mechanic')->user();

    // if (! $mechanic->hasVerifiedEmail()) {
    //     return redirect()->route('mechanic.verification.notice')
    //         ->with('error', 'You must verify your email to access the dashboard.');
    // }

    $mechanics = Mechanic::all();

    return view('mechanic.dashboard', compact('mechanics'));
}


    

    public function create()
    {
        return view('mechanic.creates');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mechanics',
            'password' => 'required|string|min:8|confirmed',
            'shopname' => 'required|string|max:255',
            'ContactNo' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        DB::beginTransaction();

        try {
            // Initialize the image path variable as null
            $imagePath = null;

            // Handle the main shop image upload (single)
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload'), $file_name);
                $imagePath = 'upload/' . $file_name;
            }

            // Generate OTP
            $otp = rand(100000, 999999); // 6-digit OTP

            // Create the Mechanic record
            $mechanic = Mechanic::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'shopname' => $request->shopname,
                'image' => $imagePath,
                'ContactNo' => $request->ContactNo,
                'Address' => $request->Address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'utype' => 'mechanic',
                'verified' => false,
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(5), // OTP valid for 30 minutes
                'email_verified_at' => null,
            ]);

            // Notify all admins about the new mechanic registration
            $admins = Admin::all();
            foreach ($admins as $admin) {
                Notification::create([
                    'admin_id' => $admin->id,
                    'message' => "A new mechanic has registered: {$mechanic->name} ({$mechanic->shopname})",
                ]);
            }

            // Handle additional images (multiple)
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    $additionalFileName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('upload'), $additionalFileName);

                    \App\Models\MechanicImage::create([
                        'mechanic_id' => $mechanic->id,
                        'image_path' => 'upload/' . $additionalFileName
                    ]);
                }
            }

            DB::commit();

            // Send OTP email
            $mechanic->notify(new SendOTPNotification($otp));

            // Redirect to OTP verification page
            return redirect()->route('mechanic.verify.otp')
                ->with('success', 'Registration successful! Please check your email for OTP verification.')
                ->with('email', $mechanic->email);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function showOTPVerificationForm()
    {
        return view('mechanic.auth.verify-otp');
    }

    public function verifyOTP(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6',
        'email' => 'required|email',
    ]);

    // Debug: Log the incoming request
    \Log::info("OTP Verification Attempt", [
        'email' => $request->email,
        'otp' => $request->otp,
        'time' => now()
    ]);

    $mechanic = Mechanic::where('email', $request->email)
                        ->where('otp', $request->otp)
                        ->where('otp_expires_at', '>', now())
                        ->first();

    // Debug: Log the query results
    \Log::info("Mechanic Found", [
        'exists' => $mechanic ? true : false,
        'otp_expires_at' => $mechanic ? $mechanic->otp_expires_at : null,
        'current_time' => now()
    ]);

    if (!$mechanic) {
        // More specific error messages
        if (!Mechanic::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'Email not found.']);
        }
        
        $existingMechanic = Mechanic::where('email', $request->email)
                                   ->where('otp', $request->otp)
                                   ->first();
        
        if (!$existingMechanic) {
            return back()->withErrors(['otp' => 'Invalid OTP code.']);
        }
        
        if ($existingMechanic->otp_expires_at <= now()) {
            return back()->withErrors(['otp' => 'OTP has expired.']);
        }
        
        return back()->withErrors(['otp' => 'Invalid OTP.']);
    }

    // Update the mechanic record
    $mechanic->update([
        'otp' => null,
        'otp_expires_at' => null,
        'email_verified_at' => now(),
        'verified' => false
    ]);

    // Debug: Log successful verification
    \Log::info("OTP Verification Successful", [
        'mechanic_id' => $mechanic->id,
        'email_verified_at' => now()
    ]);

    // Redirect to login with success message
    return redirect()->route('mechanic.login')
           ->with('success', 'OTP verified successfully. Please wait for admin approval.');
}

public function resendOTP(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $mechanic = Mechanic::where('email', $request->email)->first();

    if (!$mechanic) {
        return back()->with('error', 'Email not found.');
    }

    $otp = rand(100000, 999999);
    $otpExpiresAt = now()->addMinutes(5); // Explicit expiration time

    $mechanic->update([
        'otp' => $otp,
        'otp_expires_at' => $otpExpiresAt, // Must update expiration time!
        'email_verified_at' => null // Reset verification status
    ]);

    // Debug logging
    \Log::info("OTP Resent", [
        'email' => $request->email,
        'otp' => $otp,
        'expires_at' => $otpExpiresAt
    ]);

    $mechanic->notify(new SendOTPNotification($otp));

    return back()
        ->with('email', $request->email)
        ->with('success', 'New OTP sent! Valid for 5 minutes.');
}

    public function logout()
    {
        Auth::guard('mechanic')->logout(); // Log out the mechanic

        // Redirect to the login page with a success message
        return redirect()->route('mechanic.login')->with('success', 'Logged out successfully!');
    }

    // New methods for managing orders
    public function orders(Request $request)
{
    // 1. Get the authenticated mechanic
    $mechanic = auth()->user(); // Assuming mechanics are authenticated here

    // 2. Get all product IDs owned by this mechanic
    $productIds = \App\Models\Product::where('mechanic_id', $mechanic->id)->pluck('id');

    // 3. Get all order IDs that contain any of those products
    $orderIds = \App\Models\OrderItem::whereIn('product_id', $productIds)
        ->pluck('order_id')
        ->unique();

    // 4. Get all orders that match those IDs (optional status filter)
    $status = $request->query('status');

    $orders = Order::whereIn('id', $orderIds)
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->get();

    // 5. Calculate the counts for each status
    $pendingCount = Order::whereIn('id', $orderIds)->where('status', 'pending')->count();
    $claimCount = Order::whereIn('id', $orderIds)->where('status', 'claim')->count();
    $deniedCount = Order::whereIn('id', $orderIds)->where('status', 'denied')->count();
    $completedCount = Order::whereIn('id', $orderIds)->where('status', 'completed')->count();

    // 6. Store the counts in the session
    session([
        'pendingCount' => $pendingCount,
        'claimCount' => $claimCount,
        'deniedCount' => $deniedCount,
        'completedCount' => $completedCount,
    ]);

    // 7. Return the orders and session data to the view
    return view('mechanic.index', compact('orders'));
}



public function showOrder(Order $order)
{
    $order->load('items.product', 'mechanic', 'user.cars');

    $mechanic = Auth::guard('mechanic')->user();

    // Filter items by mechanic
    $filteredItems = $order->items->filter(function ($item) use ($mechanic) {
        return $item->product->mechanic_id === $mechanic->id;
    });

    return view('mechanic.show', [
        'order' => $order,
        'filteredItems' => $filteredItems
    ]);
}


    // Update order status based on mechanic's action
    // Update order status based on mechanic's action
    public function updateOrderStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,accepted,denied,claim,completed',
        'reason' => 'nullable|string|max:500',
    ]);

    $statusToSave = $request->status;
    $previousStatus = $order->status; // 🟢 Save the original status before updating
    $order->load('items.product');    // 🟢 Ensure products are loaded

    // ✅ User + Mechanic messages
    $userMessages = [
        'pending' => 'Your order is pending.',
        'accepted' => 'Your order has been accepted.',
        'claim' => 'Your order is now "To Be Claimed" Note: You have 3 days to claim your product. Otherwise it will be cancelled',
        'completed' => 'Your order has been completed.',
        'denied' => 'Cancelled',
        'did_not_claim' => 'You did not claim your order today.',
    ];

    $mechanicMessages = [
        'pending' => 'A new order is now pending approval.',
        'accepted' => 'A customer\'s order has been accepted for your product.',
        'claim' => 'An order is now "To Be Claimed".',
        'completed' => 'A customer\'s order has been completed.',
        'denied' => 'A customer\'s order has been denied.',
        'did_not_claim' => 'Customer did not claim their order today.',
    ];

    // ✅ Update the order
    $order->update([
        'status' => $statusToSave,
        'status_msg' => $userMessages[$statusToSave] ?? 'Order status updated.',
        'cancellation_reason' => $statusToSave === 'denied' ? $request->reason : null,
    ]);

    // ✅ Restock only if denied & previous status affected inventory
    if ($statusToSave === 'denied' && in_array($previousStatus, ['pending', 'accepted', 'claim'])) {
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->increment('Inventory', $item->quantity);
            }
        }
    }

    // ✅ Notifications
    $product = $order->items->first()->product ?? null;
    $mechanic = $product?->mechanic;

    $userMessage = $userMessages[$statusToSave] ?? 'Your order status has been updated.';
    if ($statusToSave === 'denied' && $request->reason) {
        $userMessage .= ' Reason: ' . $request->reason;
    }

    Notification::create([
        'user_id' => $order->user_id,
        'product_id' => $product?->id,
        'message' => $userMessage,
    ]);

    $mechanicMessage = $mechanicMessages[$statusToSave] ?? 'An order status has been updated.';
    if ($product) {
        $mechanicMessage .= ' Product: ' . $product->ProductName;
    }
    if ($statusToSave === 'denied' && $request->reason) {
        $mechanicMessage .= ' Reason: ' . $request->reason;
    }

    Notification::create([
        'mechanic_id' => $mechanic?->id,
        'product_id' => $product?->id,
        'message' => $mechanicMessage,
    ]);

    return redirect()->route('mechanic.orders.show', $order)
        ->with('success', 'Order status updated successfully.');
}


public function overview()
{
    if (!Auth::guard('mechanic')->check()) {
        return redirect()->route('mechanic.login')->with('error', 'You must log in to access the Overview.');
    }

    $mechanicId = Auth::guard('mechanic')->id();

    // BOOKINGS DATA

    // Total Bookings
    $totalBookings = Booking::where('mechanic_id', $mechanicId)->count();

    // Pending Bookings
    $pendingBookings = Booking::where('mechanic_id', $mechanicId)
        ->where('status', 'pending')
        ->count();

    // Completed Bookings
    $completedBookings = Booking::where('mechanic_id', $mechanicId)
        ->where('status', 'completed')
        ->count();

    // Total Earnings (This Month)
    $totalEarnings = Booking::where('bookings.mechanic_id', $mechanicId)
        ->where('bookings.status', 'completed')
        ->whereMonth('bookings.created_at', now()->month)
        ->join('services', 'bookings.service_id', '=', 'services.id')
        ->sum('services.price');

    // Recent Bookings
    $recentBookings = Booking::where('mechanic_id', $mechanicId)
    ->where('status', 'pending') // <- only pending
        ->with(['user', 'service'])
->orderBy('booking_date', 'asc')
    ->orderBy('booking_time', 'asc')        
    ->paginate(5, ['*'], 'bookings_page'); // 👈 custom page name
        // ->take(5)

        // ->get();

    // ORDERS DATA

    // Total Orders
    $totalOrders = Order::whereHas('items.product', function ($query) use ($mechanicId) {
        $query->where('mechanic_id', $mechanicId);
    })->count();
    

    // Pending Orders
    $pendingOrders = Order::where('mechanic_id', $mechanicId)
        ->where('status', 'pending')
        ->count();

    // Completed Orders
    $completedOrders = Order::where('status', 'completed')
    ->whereHas('items.product', function ($query) use ($mechanicId) {
        $query->where('mechanic_id', $mechanicId);
    })
    ->count();


    // Recent Orders
    $recentOrders = Order::where('status', 'pending') // <- only pending
    ->whereHas('items.product', function ($query) use ($mechanicId) {
        $query->where('mechanic_id', $mechanicId);
    })
    ->with(['user', 'items.product'])
    ->orderBy('created_at', 'asc')
    ->paginate(5, ['*'], 'orders_page'); // 👈 custom page name
        // ->take(5)
    // ->get();

    


    return view('mechanic.overview', compact(
        'totalBookings',
        'pendingBookings',
        'completedBookings',
        'totalEarnings',
        'recentBookings',

        // Add these
        'totalOrders',
        'pendingOrders',
        'completedOrders',
        'recentOrders'
    ));
}



public function getUnreadOrderNotifications()
{
    $mechanic = auth()->guard('mechanic')->user();

    if (!$mechanic) {
        return response()->json(['unread_count' => 0]);
    }

    $unreadCount = Notification::where('mechanic_id', $mechanic->id)
                                ->where('is_read', false)
                                ->count();

    return response()->json(['unread_count' => $unreadCount]);
}

// 🔧 Mechanic Notifications (Separated from user logic)
public function mechanicNotifications()
{
    $mechanic = Auth::guard('mechanic')->user();

    $notifications = Notification::where('mechanic_id', $mechanic->id)
        ->whereNull('user_id')
        ->with([
            'product',
            'service',
            'booking.service',
            'booking.user',
            'user'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    Notification::where('mechanic_id', $mechanic->id)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return view('mechanic.notifications', compact('notifications'));
}

public function getMechanicNotifications()
{
    $mechanicId = Auth::guard('mechanic')->id();

    $unreadCount = Notification::where('mechanic_id', $mechanicId)
        ->where('is_read', false)
        ->count();

    return response()->json(['unread_count' => $unreadCount]);
}

public function markAllMechanicNotificationsAsRead()
{
    $mechanicId = Auth::guard('mechanic')->id();

    Notification::where('mechanic_id', $mechanicId)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

public function markMechanicNotificationAsRead($id)
{
    $notification = Notification::find($id);

    if (!$notification || $notification->mechanic_id !== Auth::guard('mechanic')->id()) {
        return response()->json(['success' => false, 'message' => 'Notification not found or unauthorized.'], 404);
    }

    $notification->delete();

    return response()->json(['success' => true]);
}

public function deleteMechanicNotification($id)
    {
        $notification = Notification::find($id);

        if (!$notification || $notification->mechanic_id !== Auth::guard('mechanic')->id()) {
            return response()->json(['success' => false, 'message' => 'Notification not found or unauthorized.'], 404);
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }

public function showAllMechanics() {
    $mechanics = Mechanic::all();
    return view('mechanics-map', ['mechanics' => $mechanics]);
}

public function viewRatings()
{
    $mechanicId = auth()->guard('mechanic')->id();

    // Get product ratings where products belong to this mechanic
    $productRatings = \App\Models\ProductRating::with(['user', 'product'])
        ->whereHas('product', function ($query) use ($mechanicId) {
            $query->where('mechanic_id', $mechanicId);
        })->latest()->get();

    // Get service ratings where services belong to this mechanic
    $serviceRatings = \App\Models\ServiceRating::with(['user', 'service'])
        ->whereHas('service', function ($query) use ($mechanicId) {
            $query->where('mechanic_id', $mechanicId);
        })->latest()->get();

    // ✅ Get emergency ratings for this mechanic
    $emergencyRatings = EmergencyBookingRating::with(['user'])
        ->where('mechanic_id', $mechanicId)
        ->latest()
        ->get();

    return view('mechanic.ratings.index', compact('productRatings', 'serviceRatings', 'emergencyRatings'));
}

public function getUnreadEmergencyNotifications()
{
    $mechanicId = auth()->guard('mechanic')->id();

    $count = Notification::where('mechanic_id', $mechanicId)
        ->where('type', 'emergency_booking')
        ->where('is_read', false)
        ->count();

    return response()->json(['unread_count' => $count]);
}

public function markEmergencyNotificationsAsRead()
{
    $mechanicId = auth()->guard('mechanic')->id();

    Notification::where('mechanic_id', $mechanicId)
        ->where('type', 'emergency_booking')
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

public function downloadReceipt(Order $order)
{
    // Verify authorization - mechanic must own at least one product in the order
    $mechanicProductsInOrder = $order->items()
        ->whereHas('product', function($query) {
            $query->where('mechanic_id', auth()->guard('mechanic')->id());
        })->exists();

    if (!$mechanicProductsInOrder) {
        abort(403, 'Unauthorized action.');
    }

    // Only allow download for completed orders
    if ($order->status !== 'completed') {
        abort(403, 'Receipt is only available for completed orders.');
    }

    // Load relationships
    $order->load(['items.product.mechanic', 'user']);

    // Generate PDF using the mechanic-specific receipt view
    $pdf = \PDF::loadView('mechanic.receipt', [
        'order' => $order,
        'date' => now()->format('Y-m-d H:i:s'),
        'reference' => $this->generateOrderReference($order)
    ]);

    // Set filename with alphanumeric reference
    $filename = 'receipt-' . $this->generateOrderReference($order) . '.pdf';

    // Download the PDF
    return $pdf->download($filename);
}

private function generateOrderReference($order)
{
    $shopInitials = strtoupper(substr($order->items->first()->product->mechanic->shopname ?? 'CAR', 0, 3));
    $datePart = $order->created_at->format('Ymd');
    $randomPart = substr(md5($order->id), 0, 6);
    
    return $shopInitials . '-' . $datePart . '-' . $randomPart;
}



}