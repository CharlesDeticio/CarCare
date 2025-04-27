<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Mechanic;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showprod()
    {
        // Retrieve products associated with the authenticated mechanic
        $products = Product::where('mechanic_id', Auth::guard('mechanic')->id())->get();
        return view('mechanic.productdashboard', compact('products'));
    }

    public function created()
    {
        return view('mechanic.created');
    }

    public function store(Request $request)
{
    // Debug: Check mechanic authentication
    $mechanicId = Auth::guard('mechanic')->id();
    if (!$mechanicId) {
        return redirect()->route('mechanic.login')->with('error', 'Please log in as a mechanic.');
    }

    // Validate input data
    $field = $request->validate([
'ProductName' => [
            'required',
            'string',
            'max:255',
            // Check if product name is unique for this mechanic
            function ($attribute, $value, $fail) use ($mechanicId) {
                if (Product::where('mechanic_id', $mechanicId)
                    ->where('ProductName', $value)
                    ->exists()) {
                    $fail('You already have a product with this name.');
                }
            }
        ],
        'Description' => 'nullable|string|max:1000',
        'Price'       => 'required|numeric|min:0', // Ensure price is not negative
        'Inventory'   => 'required|integer|min:0', // Ensure inventory is not negative
        'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'color'       => 'required|string|max:255',
        'width'       => 'required|string|max:255',
        'weight'      => 'required|string|max:255',
        'height'      => 'required|string|max:255',
        'category'    => 'required|string|max:255',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload'), $file_name);
        $imagePath = $file_name;
    }

    // Create the product with the correct mechanic_id
    Product::create([
        "ProductName"  => $request->ProductName,
        "Description"  => $request->Description,
        "Price"        => $request->Price,
        "Inventory"    => max(0, $request->Inventory), // Ensure inventory is always 0 or more
        "color"        => $request->color,
        "width"        => $request->width,
        "weight"       => $request->weight,
        "height"       => $request->height,
        "category"     => $request->category,
        "image"        => $imagePath,
        "mechanic_id"  => $mechanicId, // Correct mechanic_id
    ]);

    return redirect()->route('mechanic.productdashboard')->with('success', 'Product created successfully.');
}



    public function show(Product $product)
    {
        // Ensure that the product belongs to the authenticated mechanic
        if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('mechanic.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Ensure that the product belongs to the authenticated mechanic
        if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('mechanic.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    // Ensure that the product belongs to the authenticated mechanic
    if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Validate input data
    $request->validate([
        'ProductName' => 'required|string|max:255',
        'Description' => 'nullable|string',
        'Price'       => 'required|numeric|min:0',
        'Inventory'   => 'required|integer|min:0', // Prevent negative inventory
        'color'       => 'required|string|max:255',
        'width'       => 'required|string|max:255',
        'weight'      => 'required|string|max:255',
        'height'      => 'required|string|max:255',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'category'    => 'required|string|max:255', 
    ]);

    // Build data array for update
    $data = [
        'ProductName' => strip_tags($request->input('ProductName')),
        'Description' => strip_tags($request->input('Description')),
        'Price'       => strip_tags($request->input('Price')),
        'Inventory'   => max(0, strip_tags($request->input('Inventory'))), // Ensure it remains positive
        'color'       => $request->color,
        'width'       => $request->width,
        'weight'      => $request->weight,
        'height'      => $request->height,
        'category'    => $request->category,
    ];

    // Check if a new image file is uploaded
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload'), $file_name);
        $data['image'] = $file_name;
    }

    // Update the product
    $product->update($data);

    return redirect()->route('mechanic.productdashboard')->with('success', 'Product updated successfully.');
}


    public function destroy(Product $product)
    {
        // Ensure that the product belongs to the authenticated mechanic
        if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the product
        $product->delete();

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product deleted successfully.');
    }
    
    // If you need a public view for the product (e.g., for customers)
    public function shows($id) {
        // Fetch the product
        $product = Product::findOrFail($id);
    
        // Fetch the related mechanic
        $mechanic = Mechanic::where('id', $product->mechanic_id)->first();
    
        // Calculate the average rating for this product
        $averageRating = $product->ratings()->avg('rating');
    
        // Pass the data to the view
        return view('product-view', compact('mechanic', 'product', 'averageRating'));
    }
    

    // In your Controller
// In your Controller
public function showed($id) {
    // Assume you have a Mechanic model and you are fetching the mechanic by ID
    $mechanic = Mechanic::findOrFail($id); // Fetch the mechanic or throw a 404 if not found

    return view('user.product', compact('mechanic'));
}

public function addInventory(Request $request, $id)
{
    $request->validate([
        'added_inventory' => 'required|integer|min:1'
    ]);

    $product = Product::findOrFail($id);

    // Ensure that the product belongs to the authenticated mechanic
    if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Add the new inventory
    $product->Inventory += $request->input('added_inventory');
    $product->save();

    return redirect()->route('mechanic.productdashboard')->with('success', 'Inventory updated successfully.');
}

// Display all products (for users or admins)
public function allProducts(Request $request)
{
    $query = Product::query();

    // Filter by product name (search)
    if ($request->filled('search')) {
        $query->where('ProductName', 'like', '%' . $request->search . '%');
    }

    // Filter by category
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    // Get filtered products
    $products = $query->get();

    // Fetch distinct categories for the filter dropdown
    $categories = Product::select('category')->distinct()->pluck('category');

    $mechanic = Auth::user(); // or Auth::guard('mechanic')->user();

    // Return the view with both products and categories
    return view('all-products', compact('products', 'categories'));
}


    
}
