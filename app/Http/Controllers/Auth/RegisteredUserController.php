<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Car; // Make sure to import the Car model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Notification;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SendOTPNotification;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'integer'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'car_type.*' => ['required', 'string', 'max:255'],
            'car_model.*' => ['required', 'string', 'max:255'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
            $imagePath = $file_name;
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        $otpExpiresAt = Carbon::now()->addMinutes(5);

        // Create user with OTP
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'province' => $request->province,
            'region' => $request->region,
            'zip_code' => $request->zip_code,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
            'otp' => $otp,
            'otp_expires_at' => $otpExpiresAt,
            'email_verified_at' => null,
        ]);

        // Notify admins
        $admins = Admin::all();
        foreach ($admins as $admin) {
            Notification::create([
                'admin_id' => $admin->id,
                'message' => "A new user has registered: {$user->first_name} {$user->last_name}",
            ]);
        }

        // Save cars
        if ($request->has('car_type') && $request->has('car_model')) {
            foreach ($request->car_type as $index => $carType) {
                Car::create([
                    'user_id' => $user->id,
                    'car_type' => $carType,
                    'car_model' => $request->car_model[$index] ?? null,
                ]);
            }
        }

        // Send OTP
        $user->notify(new SendOTPNotification($otp));

        // Redirect to OTP verification page
        return redirect()->route('otp.verify')
            ->with('email', $user->email)
            ->with('success', 'Registration successful! Please check your email for the OTP.');
    }

    // In RegisteredUserController
public function showOTPVerificationForm()
{
    return view('auth.verify-otp');
}

public function verifyOTP(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6',
        'email' => 'required|email|exists:users,email'
    ]);

    // Debug logging
    \Log::info("OTP verification attempt", [
        'email' => $request->email,
        'otp' => $request->otp
    ]);

    $user = User::where('email', $request->email)
                ->where('otp', $request->otp)
                ->where('otp_expires_at', '>', now())
                ->first();

    if (!$user) {
        // More specific error messages
        if (!User::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'Email not found.']);
        }
        
        if (!User::where('email', $request->email)->where('otp', $request->otp)->exists()) {
            return back()->withErrors(['otp' => 'Invalid OTP code.']);
        }
        
        return back()->withErrors(['otp' => 'OTP has expired.']);
    }

    // Mark as verified
    $user->update([
        'email_verified_at' => now(),
        'otp' => null,
        'otp_expires_at' => null
    ]);

    // Log the user in
    Auth::login($user);

    // Clear the email from session
    $request->session()->forget('email');

    // Debug
    \Log::info("User {$user->id} successfully verified OTP");

    // Redirect to intended page
    return redirect()->intended(route('dashboard'))
        ->with('verified', true);   
}

public function resendOTP(Request $request)
{
    $request->validate(['email' => 'required|email|exists:users,email']);

    $user = User::where('email', $request->email)->first();
    
    // Generate new OTP
    $newOtp = rand(100000, 999999);
    $otpExpiresAt = now()->addMinutes(5);

    // Debug logging
    \Log::info("Resending OTP for user: {$user->id}");
    \Log::info("New OTP: {$newOtp}, Expires at: {$otpExpiresAt}");

    // Update user with new OTP
    $user->update([
        'otp' => $newOtp,
        'otp_expires_at' => $otpExpiresAt,
        'email_verified_at' => null // Reset verification status
    ]);

    // Send notification
    $user->notify(new SendOTPNotification($newOtp));

    return back()
        ->with('email', $user->email) // Maintain email in session
        ->with('status', 'A new OTP has been sent to your email.');
}
}
