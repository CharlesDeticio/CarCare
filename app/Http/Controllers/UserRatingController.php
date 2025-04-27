<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;


class UserRatingController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        // Find the order and make sure it belongs to the user
        $order = Order::with('items')->where('id', $request->order_id)
            ->where('user_id', $userId)
            ->where('status', 'completed') // ✅ Ensure it's completed!
            ->first();

        if (!$order) {
            return back()->with('error', 'Order not found or not eligible for rating.');
        }

        // Verify the product exists in this order
        $productInOrder = $order->items->where('product_id', $request->product_id)->first();

        if (!$productInOrder) {
            return back()->with('error', 'You can only rate products you purchased.');
        }

        // Check for existing rating for this product & order
        $existingRating = ProductRating::where('product_id', $request->product_id)
            ->where('user_id', $userId)
            ->where('order_id', $order->id)
            ->first();

        if ($existingRating) {
            return back()->with('error', 'You have already rated this product for this order.');
        }

        // Save the rating
        ProductRating::create([
            'product_id' => $request->product_id,
            'order_id'   => $order->id,
            'user_id'    => $userId,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your rating!');
    }


}
