<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Add a product to the cart
    public function add(Request $request, $id)
    {
        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add items to the cart.');
        }

        // Retrieve product
        $product = Product::findOrFail($id);

        // Check if the product is out of stock
        if ($product->Inventory <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        // Use a database transaction to ensure data consistency
        DB::transaction(function () use ($product) {
            // Check if the product is already in the user's cart
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->lockForUpdate() // Lock the row for update
                            ->first();

            if ($cartItem) {
                // Check if adding another item would exceed the available inventory
                if ($cartItem->quantity + 1 > $product->Inventory) {
                    throw new \Exception('Cannot add more items than available in stock.');
                }

                // If the product exists in the cart, increase quantity
                $cartItem->increment('quantity');
            } else {
                // If not in cart, add new entry
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->Price
                ]);
            }
        });

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // Display the cart items
    public function index()
    {
        $cartItems = auth()->user()->carts()->with('product')->latest()->get();
        $cartItemCount = $this->getCartItemCount(); // Fetch cart item count
        return view('cart.index', compact('cartItems', 'cartItemCount'));
    }

    // Add a product to the cart (alternative method)
    public function store(Request $request, Product $product)
    {
        // Ensure the product is in stock
        if ($product->Inventory <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        // Use a database transaction to ensure data consistency
        DB::transaction(function () use ($product) {
            // Check if the product is already in the user's cart
            $cart = Cart::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->lockForUpdate() // Lock the row for update
                        ->firstOrCreate([], [
                            'quantity' => 0,
                        ]);

            // Check if adding another item would exceed the available inventory
            if ($cart->quantity + 1 > $product->Inventory) {
                throw new \Exception('Cannot add more items than available in stock.');
            }

            // Increment the quantity
            $cart->increment('quantity');
        });

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    // Remove a product from the cart
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    // Increase the quantity of a cart item
    public function increment(Cart $cart)
    {
        // Retrieve the product to check inventory
        $product = $cart->product;

        // Check if adding another item would exceed the available inventory
        if ($cart->quantity + 1 > $product->Inventory) {
            return redirect()->route('cart.index')->with('error', 'Cannot add more items than available in stock.');
        }

        // Increase the quantity of the cart item
        $cart->increment('quantity');
        return redirect()->route('cart.index')->with('success', 'Product quantity increased.');
    }

    // Decrease the quantity of a cart item
    public function decrement(Cart $cart)
    {
        // Only decrease the quantity if it's greater than 1, or optionally remove the item if quantity is 1
        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
            return redirect()->route('cart.index')->with('success', 'Product quantity decreased.');
        } else {
            // Optionally, you can delete the cart item if the quantity drops to 0
            $cart->delete();
            return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
        }
    }

    // Helper method to calculate the total number of items in the cart
    public function getCartItemCount()
    {
        if (Auth::check()) {
            return auth()->user()->carts()->count();
        }
        return 0;
    }
    public function update(Request $request, Cart $cart)
{
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1|max:' . $cart->product->Inventory
    ]);
    
    $cart->update(['quantity' => $validated['quantity']]);
    
    return back()->with('success', 'Cart updated successfully');
}
}