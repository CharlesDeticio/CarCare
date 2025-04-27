<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mechanic;
use App\Models\Notification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\MechanicApprovedMail;
use App\Mail\MechanicDeniedMail;
use Illuminate\Support\Facades\Auth;
    

class AdminController extends Controller
{
    public function showUsers()
    {
        $admin = Auth::guard('admin')->user(); // Make sure your guard is set up
        $mechanics = Mechanic::all();

        $notifications = Notification::where('admin_id', $admin->id)
        ->latest()
        ->take(10)
        ->get();

        return view('admin.dashboard', compact( 'mechanics', 'admin'));
    }

    public function indexUser()
    {
        $users = User::all();
        return view('admin.indexuser', compact('users'));

    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
        }

        $mechanic = Mechanic::find($id);
        if ($mechanic) {
            $mechanic->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Mechanic deleted successfully.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'User or Mechanic not found.');
    }

    // 🔹 Function to show user details
    public function viewUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.view-user', compact('user'));
    }

    // 🔹 Function to show mechanic details
    public function viewMechanic($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        return view('admin.view-mechanic', compact('mechanic'));
    }

    public function approveMechanic($id)
{
    $mechanic = Mechanic::findOrFail($id);

    $mechanic->verified = true;
    $mechanic->save();

    // ✅ Send approval email
    Mail::to($mechanic->email)->send(new MechanicApprovedMail($mechanic));

     // ✅ Add notification for the mechanic
     Notification::create([
        'mechanic_id' => $mechanic->id,
        'message' => "Your mechanic account has been approved by the admin.",
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Mechanic approved and notified successfully!');
}
public function denyMechanic($id)
{
    $mechanic = Mechanic::findOrFail($id);

    // ✅ Send denial email BEFORE deleting (so email still works)
    Mail::to($mechanic->email)->send(new MechanicDeniedMail($mechanic));

    // ✅ Notify (if you want to log this)
    Notification::create([
        'mechanic_id' => $mechanic->id,
        'message' => "Your mechanic account has been denied by the admin.",
    ]);
    // Optional: delete or deactivate
    $mechanic->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Mechanic denied and notified successfully.');
}


    
}
