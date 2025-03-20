<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "login failed");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:8",
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            event(new Registered($user));
            return redirect()->route('login')->with('Success', 'Please verify your email address.');
        }

        return redirect(route("register"))->with("Error", "Registration failed. Please try again.");
    }

    //Verify email notice handler
    public function verifyNotice()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Manually check if the email is verified
            if ($user->email_verified_at) {
                return redirect('/index');
            }
        }

        // If the user is not authenticated or has not verified their email, show the verification page
        return view('auth.verify-email');
    }

    // Logout function (must be outside of verifyNotice)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    //Email verification Handler route
    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/index');
    }
    //Resending the verification email handler
    public function verifyHandler(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    
}
