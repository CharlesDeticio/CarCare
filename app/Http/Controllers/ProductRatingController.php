<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    // Store a product rating
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        // Prevent duplicate ratings (1 user, 1 product)
        $existingRating = ProductRating::where('product_id', $productId)
                                       ->where('user_id', $userId)
                                       ->first();

        if ($existingRating) {
            return back()->with('error', 'You have already rated this product.');
        }

        ProductRating::create([
            'product_id' => $productId,
            'user_id'    => $userId,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Thank you for rating this product!');
    }
}
