<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MechanicProfileController extends Controller
{
    public function showProfile()
    {
        $mechanic = Auth::guard('mechanic')->user();
        return view('mechanic.profile', compact('mechanic'));
    }

    public function updateProfile(Request $request)
{
    $mechanic = Auth::guard('mechanic')->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'ContactNo' => 'required|string|max:20',
        'Address' => 'required|string|max:255',
        'shopname' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    

    $mechanic->name = $request->name;
    $mechanic->email = $request->email;
    $mechanic->ContactNo = $request->ContactNo;
    $mechanic->Address = $request->Address;
    $mechanic->shopname = $request->shopname;


    if ($request->hasFile('image')) {
    $file = $request->file('image');
    $file_name = time() . $file->getClientOriginalName();
    $file->move(public_path('upload'), $file_name);
    $mechanic->image = 'upload/' . $file_name;  // Store with directory
}

    $mechanic->save();

    return redirect()->route('mechanic.profile')->with('success', 'Profile updated successfully!');
}


    public function edit()
{
    $mechanic = Auth::guard('mechanic')->user();
    return view('mechanic.profile-edit', compact('mechanic'));
}

}
