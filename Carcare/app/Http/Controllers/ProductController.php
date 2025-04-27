<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products
        return view('mechanic.dashboard', compact('products'));
    }

    public function create()
    {
        return view('mechanic.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric',
            'Inventory' => 'required|integer',
        ]);

        Product::create($request->all());

        return redirect()->route('mechanic.dashboard')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('mechanic.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('mechanic.dashboard')->with('success', 'Product deleted successfully.');
    }
}
