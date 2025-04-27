<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Car; // Add this at the top if not yet


class ProfileController extends Controller
{
    // View profile page
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // Edit profile page
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Update profile
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'province' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'zip_code' => 'required|integer',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
        'image' => 'nullable|image|max:2048',

        // Validate car_type[] and car_model[]
        'car_type' => 'required|array',
        'car_type.*' => 'required|string|max:255',
        'car_model' => 'required|array',
        'car_model.*' => 'required|string|max:255',
    ]);

    // Update user info
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->address = $request->address;
    $user->province = $request->province;
    $user->region = $request->region;
    $user->zip_code = $request->zip_code;
    $user->phone_number = $request->phone_number;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file_name = time() . $file->getClientOriginalName();
        $file->move(public_path('upload'), $file_name);
        $user->image = $file_name;
    }

    $user->save(); // Save the user first!

    // ✅ Now Handle the CARS

    // 1. Delete old cars of this user
    Car::where('user_id', $user->id)->delete();

    // 2. Insert new cars
    foreach ($request->car_type as $index => $carType) {
        Car::create([
            'user_id' => $user->id,
            'car_type' => $carType,
            'car_model' => $request->car_model[$index], // match car_model array
        ]);
    }

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
}
}
