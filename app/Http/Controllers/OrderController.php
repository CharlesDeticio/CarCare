<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade\Pdf;



use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product','mechanic')->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
{
    $user = auth()->user();

    // Get the user's cart items (each linked to a product)
    $cartItems = $user->carts()->with('product.mechanic')->get();

    // Check if the cart is empty
    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    // Validate inventory for each item in the cart
    foreach ($cartItems as $item) {
        $product = $item->product;

        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
        }

        if ($product->Inventory < $item->quantity) {
            return redirect()->route('cart.index')->with('error', 'Insufficient inventory for ' . $product->ProductName);
        }
    }

    // Calculate the total amount
    $totalAmount = $cartItems->sum(function ($item) {
        return $item->quantity * $item->product->Price;
    });

    // Get the mechanic from the first product in the cart
    $firstProduct = $cartItems->first()->product;

    // Ensure the mechanic_id is not NULL
    if (!$firstProduct->mechanic_id) {
        return redirect()->route('cart.index')->with('error', 'The product is not linked to a mechanic.');
    }
    
    // Create the order
    $order = Order::create([
        'user_id' => $user->id,
        'product_id' => $firstProduct->id,  // Use the first product's ID
        'mechanic_id' => $firstProduct->mechanic_id,  // Use the first product's mechanic_id
        'total_amount' => $totalAmount,
        'status' => 'pending',
        'status_msg' => 'Order has been placed and is pending approval.',
        'payment_method' => $request->payment_method ?? 'Cash on Delivery',
    ]);
    

    // Add each cart item as an order item and deduct inventory
    foreach ($cartItems as $item) {
        $product = $item->product;

        // Deduct inventory safely
        if ($product->Inventory >= $item->quantity) {
            $product->decrement('Inventory', $item->quantity);
        }

        // Add to order items
        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => $item->quantity,
            'price' => $product->Price,
        ]);
    }

    // Clear the user's cart after placing the order
    $user->carts()->delete();

    // Create notifications for each mechanic in the cart items
    $mechanicIds = [];
    foreach ($cartItems as $item) {
        $product = $item->product;

        // Notify the user (optional for each product or just once)
        Notification::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'mechanic_id' => $product->mechanic_id,
            'message' => 'Your order for ' . $product->ProductName . ' is pending approval.',
        ]);

        // Notify the mechanic only once (optional)
        if (!in_array($product->mechanic_id, $mechanicIds)) {
            Notification::create([
                'user_id' => $product->mechanic_id,
                'product_id' => $product->id,
                'mechanic_id' => $product->mechanic_id,
                'message' => 'A new order has been placed for your product(s). Please review and approve.',
            ]);

            $mechanicIds[] = $product->mechanic_id;
        }
    }

    return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
}



    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status,
        'status_msg' => $statusMessages[$request->status] ?? 'Order Status updated.', // ✅ Set dynamic status message
    ]);
        return redirect()->route('orders.index')->with('success', 'Order status updated.');
    }

    public function show(Order $order)
{
    // Ensure the order belongs to the authenticated user
    if ($order->user_id !== auth()->id()) {
        return redirect()->route('orders.index')->with('error', 'You are not authorized to view this order.');
    }

    // Load the order with its items and products
    $order->load('items.product');

    // Check if the user has already rated the first product in the order
    $productId = $order->items->first()->product_id ?? null;

    $existingRating = null;

    if ($productId) {
        $existingRating = \App\Models\ProductRating::where('product_id', $productId)
                            ->where('user_id', auth()->id())
                            ->where('order_id', $order->id) // Only if you store order_id in the ratings table!
                            ->first();
    }

    return view('orders.show', compact('order', 'existingRating'));
}


public function pendingOrders()
{
    $orders = auth()->user()->orders()
        ->with('mechanic')
        ->where('status', 'pending')
                ->latest()
        ->get();

    return view('user.pending', compact('orders'));
}

public function inTransitOrders()
{
    $orders = auth()->user()->orders()
        ->with('mechanic')
        ->where('status', 'claim')
                ->latest()
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
                ->latest()
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



    public function paymentPage()
{
    return view('payment');
}

public function showed($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function cancelOrder(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'reason' => 'required|string|max:500',
    ]);

    $order = Order::with(['items.product', 'mechanic'])->findOrFail($request->order_id);

    // Verify that the order belongs to the authenticated user
    if ($order->user_id !== auth()->id()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    // Ensure the order is in a cancelable status
    if (!in_array($order->status, ['pending', 'accepted'])) {
        return response()->json(['success' => false, 'message' => 'This order cannot be canceled.'], 400);
    }

    // Define status messages
    $userMessages = [
        'canceled' => 'You canceled your order #' . $order->id . '.',
    ];

    $mechanicMessages = [
        'canceled' => 'A customer canceled Order #' . $order->id . '.',
    ];

    // Cancel the order
    $order->update([
        'status' => 'canceled',
        'status_msg' => $userMessages['canceled'],
        'cancellation_reason' => $request->reason,
    ]);

    // Restore inventory
    foreach ($order->items as $item) {
        $product = $item->product;
        if ($product) {
            $product->increment('Inventory', $item->quantity);
        }
    }

    // Notify the mechanic
    Notification::create([
        'user_id' => $order->mechanic_id,
        'mechanic_id' => $order->mechanic_id,
        'product_id' => $order->product_id,
        'message' => $mechanicMessages['canceled'] . ' Reason: ' . $request->reason,
        'is_read' => false,
    ]);

    // Notify the user
    Notification::create([
        'user_id' => $order->user_id,
        'mechanic_id' => null,
        'product_id' => $order->product_id,
        'message' => $userMessages['canceled'] . ' Reason: ' . $request->reason,
        'is_read' => false,
    ]);

    return response()->json(['success' => true, 'message' => 'Order canceled successfully.']);
}

public function updateOrderStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,accepted,denied,claim,completed',
        'reason' => 'nullable|string|max:500',
    ]);

    $statusToSave = $request->status;

    $order->update([
        'status' => $statusToSave,
        'status_msg' => ucfirst(str_replace('_', ' ', $statusToSave)),
        'cancellation_reason' => $request->reason,
    ]);

    // ✅ Restock if it's denied due to no claim
    if ($statusToSave === 'denied' && $request->reason === 'Customer did not show up to claim the order.') {
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->increment('Inventory', $item->quantity);
            }
        }
    }

    return redirect()->route('mechanic.orders.show', $order)->with('success', 'Order marked as Denied.');
}




public function storeRating(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'rating'   => 'required|integer|min:1|max:5',
        'comment'  => 'nullable|string|max:1000',
    ]);

    $order = Order::with('items')->findOrFail($request->order_id);

    if ($order->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    $productId = $order->items->first()->product_id ?? null;

    if (!$productId) {
        return redirect()->back()->with('error', 'No product found in order to rate.');
    }

    $existingRating = \App\Models\ProductRating::where('product_id', $productId)
                            ->where('user_id', auth()->id())
                            ->where('order_id', $order->id)
                            ->first();

    if ($existingRating) {
        return redirect()->back()->with('error', 'You have already rated this order.');
    }

    $rating = \App\Models\ProductRating::create([
        'product_id' => $productId,
        'order_id'   => $order->id,
        'user_id'    => auth()->id(),
        'rating'     => $request->rating,
        'comment'    => $request->comment,
    ]);

    $product = Product::find($productId);
    $mechanic = $product?->mechanic;

    // ✅ Notify only the user (with message and comment)
    Notification::create([
        'user_id'            => auth()->id(),
        'product_id'         => $productId,
        'product_rating_id'  => $rating->id,
        'message'            => 'Your review has been submitted successfully.',
        'is_read'            => false,
    ]);

    // ✅ Notify only the mechanic (no comment)
    if ($mechanic) {
        Notification::create([  
            // 'user_id'            => $mechanic->id,   // Mechanic receives it
            'mechanic_id'        => $mechanic->id,
            'product_id'         => $productId,
            'product_rating_id'  => $rating->id,
            'message'            => 'Your product has received a new rating.',
            'is_read'            => false,
        ]);
    }

    return redirect()->back()->with('success', 'Thank you for your rating!');
}

public function downloadReceipt(Order $order)
{
    // Verify authorization
    if ($order->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Only allow download for completed orders
    if ($order->status !== 'completed') {
        abort(403, 'Receipt is only available for completed orders.');
    }

    // Load relationships
    $order->load(['items.product.mechanic', 'user']);

    // Generate PDF - now pointing to orders.receipt instead of user.orders.receipt
    $pdf = \PDF::loadView('orders.receipt', [
        'order' => $order,
        'date' => now()->format('Y-m-d H:i:s')
    ]);

    // Set filename
    $filename = 'receipt-' . $order->id . '.pdf';

    // Download the PDF
    return $pdf->download($filename);
}
}