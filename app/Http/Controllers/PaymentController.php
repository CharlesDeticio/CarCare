<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display the payment page for selected cart items or Buy Now product.
     */
    public function index(Request $request, $productId = null)
    {
        $user = auth()->user();

        if ($productId) {
            // ✅ Buy Now flow
            $product = Product::findOrFail($productId);

            $cartItems = collect([
                (object)[
                    'product_id' => $product->id,
                    'product'    => $product,
                    'quantity'   => 1,
                ]
            ]);

            $totalAmount = $product->Price;
            $isBuyNow = true;

        } elseif ($request->has('selected_items')) {
            // ✅ Cart Checkout with selected items
            $selectedIds = explode(',', $request->selected_items);

            $cartItems = $user->carts()
                ->whereIn('id', $selectedIds)
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'No products selected or invalid selection.');
            }

            $totalAmount = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->Price;
            });

            $isBuyNow = false;

        } else {
            // ✅ Fallback: entire cart (optional)
            return redirect()->route('cart.index')->with('error', 'No products selected.');
        }

        // ✅ Save the checkout data in session
        session()->put('cart_data', [
            'user_id'      => $user->id,
            'total_amount' => $totalAmount,
            'cart_items'   => $cartItems,
            'isBuyNow'     => $isBuyNow
        ]);

        return view('payments.index', compact('totalAmount', 'cartItems', 'isBuyNow'));
    }

    /**
     * Process the payment for Buy Now or Cart Checkout.
     */
    public function process(Request $request)
{
    $cartData = session()->get('cart_data');

    if (!$cartData) {
        return redirect()->route('cart.index')->with('error', 'Cart session expired.');
    }

    // ✅ Update quantities from the request
    $quantities = $request->input('quantities');

    // Create a new collection of updated cart items
    $updatedCartItems = collect($cartData['cart_items'])->map(function ($item) use ($quantities, $cartData) {
        $itemId = $cartData['isBuyNow'] ? $item->product_id : $item->id;

        if (isset($quantities[$itemId])) {
            $newQty = (int) $quantities[$itemId];

            // Validate quantity boundaries
            if ($newQty > 0 && $newQty <= $item->product->Inventory) {
                $item->quantity = $newQty; // ✅ Update the quantity!
            }
        }

        return $item; // return the updated item!
    });

    // ✅ Recalculate total amount based on updated quantities
    $totalAmount = $updatedCartItems->sum(function ($item) {
        return $item->quantity * $item->product->Price;
    });

    // ✅ Save updated cart data back to session (optional for debugging)
    $cartData['cart_items'] = $updatedCartItems;
    $cartData['total_amount'] = $totalAmount;
    session()->put('cart_data', $cartData);

    // ✅ Create the order
    $order = Order::create([
        'user_id'      => $cartData['user_id'],
        'total_amount' => $totalAmount,
        'status'       => 'pending',
        'status_msg'   => 'Your order is pending.'
    ]);

    // ✅ Create Order Items from updated cart items
    foreach ($updatedCartItems as $item) {
        // Get the correct product
        $product = $cartData['isBuyNow']
            ? Product::find($item->product_id)
            : $item->product;
    
        if ($product) {
            // Create the order item
            $order->items()->create([
                'product_id' => $product->id,
                'quantity'   => $item->quantity,
                'price'      => $product->Price,
            ]);
    
            // Decrement the inventory
            $product->decrement('Inventory', $item->quantity);
        }
    }
    

    // ✅ Notify users
    foreach ($updatedCartItems as $item) {
        $product = $cartData['isBuyNow']
            ? Product::find($item->product_id)
            : $item->product;

        if (!$product) continue;

        Notification::create([
            'user_id'     => $cartData['user_id'],
            'product_id'  => $product->id,
            // 'mechanic_id' => $product->mechanic?->id,
            'message'     => 'Your order for "' . $product->ProductName . '" is pending.'
        ]);
    }

    // ✅ Notify mechanics (avoiding duplicates)
    $notifiedMechanicIds = [];

    foreach ($updatedCartItems as $item) {
        $product = $cartData['isBuyNow']
            ? Product::find($item->product_id)
            : $item->product;

        if (!$product || !$product->mechanic) continue;

        $mechanic = $product->mechanic;

        if (!in_array($mechanic->id, $notifiedMechanicIds)) {
            Notification::create([
                'mechanic_id' => $mechanic->id,
                'product_id'  => $product->id,
                'message'     => 'A new order is now pending approval.'
            ]);

            $notifiedMechanicIds[] = $mechanic->id;
        }
    }

    // ✅ Remove checked out cart items (only in Cart Checkout mode)
    if (!$cartData['isBuyNow']) {
        $user = Auth::user();
        $selectedCartIds = $updatedCartItems->pluck('id');
        $user->carts()->whereIn('id', $selectedCartIds)->delete();
    }

    // ✅ Clear session cart data
    session()->forget('cart_data');

    return redirect()->route('user.pending')->with('success', 'Payment successful! Your order has been placed.');
}

}
    