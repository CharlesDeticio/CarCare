<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mechanic;

class AdminController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        //return view('admin.dashboard', compact('users'));


        $mechanics = Mechanic::all();
        //return view('admin.dashboard', compact('mechanics'));

        return view('admin.dashboard', compact('users', 'mechanics'));
    }
    public function destroy($id)
    {
        $users = User::find($id);
        if ($user) {
            $user->delete();
        }

        $mechanic = Mechanic::find($id);
        if ($mechanic) {
            $mechanic->delete();
        }

        //$admins = Admin::find($id);
        // Delete the resource
        //$users->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');

    
    }
    
}