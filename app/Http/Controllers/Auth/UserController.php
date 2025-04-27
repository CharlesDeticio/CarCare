<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mechanic;
use App\Models\Service;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showMechanic(Request $request)
{
    $user = Auth::user(); // Already authenticated by middleware

    $query = $request->input('q');

    if ($query) {
        $mechanics = Mechanic::where('verified', true)
            ->where(function ($q) use ($query) {
                $q->where('shopname', 'LIKE', "%{$query}%")
                  ->orWhere('Address', 'LIKE', "%{$query}%");
            })
            ->get();
    } else {
        $mechanics = Mechanic::where('verified', true)->get();
    }

    return view('dashboard', compact('mechanics', 'user'));
}




    // 🔹 Function to show mechanic details
    public function viewMechanic($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        $services = Service::where('mechanic_id', $id)->get();

        return view('user.services', compact('mechanic', 'services'));
    }

    public function viewMechanics($id)
{
    $mechanic = Mechanic::findOrFail($id);

    // Eager load product ratings
    $products = Product::with('ratings')->where('mechanic_id', $id)->get();

    // Add average rating and count for each product
    foreach ($products as $product) {
        $product->average_rating = $product->ratings()->avg('rating') ?? 0;
        $product->ratings_count = $product->ratings()->count();
    }

    return view('user.product', compact('mechanic', 'products'));
}


public function pendingOrders()
{
    $orders = auth()->user()->orders()
        ->with('mechanic')
        ->where('status', 'pending')
        ->get();

    return view('user.pending', compact('orders'));
}

public function inTransitOrders()
{
    $orders = auth()->user()->orders()
        ->with('mechanic')
        ->where('status', 'claim')
        ->get();

    return view('user.claim', compact('orders'));
}

public function deniedOrders()
{
    $orders = auth()->user()->orders()
        ->with('mechanic')
        ->whereIn('status', ['denied', 'cancelled', 'did_not_claim'])
        ->latest()
        ->get();

    return view('user.denied', compact('orders'));
}

public function completedOrders()
{
    $orders = auth()->user()->orders()
        ->with('mechanic')
        ->where('status', 'completed')
        ->get();

    return view('user.completed', compact('orders'));
}

public function acceptedOrders()
{
    $orders = auth()->user()->orders()
        ->with('mechanic')
        ->where('status', 'accepted')
        ->get();

    return view('user.accepted', compact('orders'));
}

    // 🔹 Function to cancel an order
    // public function cancelOrder(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'order_id' => 'required|exists:orders,id',
    //         'reason' => 'required|string|max:500',
    //     ]);

    //     // Find the order
    //     $order = Order::findOrFail($request->order_id);

    //     // Ensure the order belongs to the authenticated user
    //     if ($order->user_id !== auth()->id()) {
    //         return redirect()->back()->with('error', 'You are not authorized to cancel this order.');
    //     }

    //     // Update the order status and cancellation reason
    //     $order->status = 'denied';
    //     $order->cancellation_reason = $request->reason;
    //     $order->save();

    //     // Redirect back with a success message
    //     return redirect()->route('user.pending')->with('success', 'Order has been cancelled.');
    // }

    public function cancelOrder(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'reason' => 'required|string|max:500',
    ]);

    $order = Order::with(['items.product', 'mechanic'])->findOrFail($request->order_id);

    if ($order->user_id !== auth()->id()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    // Update the order status
    $order->update([
        'status' => 'denied',
        'status_msg' => 'Order canceled by the customer.',
        'cancellation_reason' => $request->reason,
    ]);

    // Restore inventory for each item in the order
    foreach ($order->items as $item) {
        $product = $item->product;
        if ($product) {
            $product->increment('Inventory', $item->quantity);
        }
    }

    $firstProduct = $order->items->first()->product ?? null; // grab first product

    // ✅ Notify Mechanic
    \App\Models\Notification::create([
        'user_id' => null,  
        'mechanic_id' => $firstProduct ? $firstProduct->mechanic_id : null,
        'product_id' => $firstProduct ? $firstProduct->id : null,
        'message' => 'A customer canceled Order' .  '. Reason: ' . $request->reason,
        'is_read' => false,
    ]);

    // ✅ Notify User
    \App\Models\Notification::create([
        'user_id' => $order->user_id,
        'mechanic_id' => null,
        'product_id' => $firstProduct ? $firstProduct->id : null,
        'message' => 'You canceled your Order' . '. Reason: ' . $request->reason,
        'is_read' => false,
    ]);
// . $order->id 
    return response()->json(['success' => true, 'message' => 'Order canceled successfully.']);
}


public function getNotifications()
{
    $notifications = \App\Models\Notification::with('product')
        ->where('user_id', auth()->id())
        ->where('status', 'unread')
        ->latest()
        ->get();

    return response()->json($notifications);
}



}