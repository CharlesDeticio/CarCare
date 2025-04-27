<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MechanicController extends Controller
{
    public function index()
    {
        $mechanics = Mechanic::all(); // Fetch all mechanics
        return view('mechanics.index', compact('mechanics'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mechanics',
            'password' => 'required|string|min:8|confirmed',
            'shopname' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $mechanic = new Mechanic();
        $mechanic->name = $request->name;
        $mechanic->email = $request->email;
        $mechanic->password = Hash::make($request->password);
        $mechanic->shopname = $request->shopname;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $mechanic->image = $imagePath;
        }

        $mechanic->save();

        return redirect()->route('mechanic.dashboard');
    }
}

