<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister()
    {
        return view('dashboard.auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'position' => 'nullable|string',
            'role' => 'in:admin,user',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'role' => $request->role ?? 'user',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Registration successful.');
    }

    // Show Login Page
    public function showLogin()
    {
        return view('dashboard.auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard')->with('success', 'Login successful.');
        }

        throw ValidationException::withMessages(['email' => 'Invalid credentials.']);
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }

    // Show Forgot Password Page
    public function showLinkRequestForm()
    {
        return view('dashboard.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
    
        // Send the password reset link, which will generate the token automatically
        $status = Password::sendResetLink($request->only('email'));
    
        // Assuming you already have the user object (or donor object) for the donation email
        $user = User::where('email', $request->email)->first(); // Get the user by email
    
    
        // Return response based on the status of the reset link
        if ($status === Password::RESET_LINK_SENT) {
            // ✅ Redirects back with success message
            return view('dashboard.auth.email-sent')->with('status', trans($status));
        } else {
            // ✅ Returns with error message
            return back()->withErrors(['email' => trans($status)]);
        }
    }

    public function showResetForm($token)
    {
        return view('dashboard.auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                // ✅ Automatically logs in the user
                Auth::login($user);
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // ✅ Redirect to homepage (or dashboard) after successful reset
            return redirect()->route('dashboard.home')->with('status', __('Your password has been reset successfully!'));
        }

        return back()->withErrors(['email' => __($status)]);
    }

}
