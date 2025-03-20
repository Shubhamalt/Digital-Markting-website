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

    public function loginPost(Request $request)
{
    $request->validate([
        "email" => "required|email",
        "password" => "required",
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with("error", "Invalid email or password.");
    }

    Auth::login($user);
    return redirect()->intended(route('home'));
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
            return redirect()->route('verification.notice')->with('Success', 'Please verify your email address.');
        }

        return redirect(route("register"))->with("Error", "Registration failed. Please try again.");
    }

    public function verifyNotice()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->email_verified_at) {
                return redirect('/index');
            }
        }

        return view('auth.verify-email');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }

    public function verifyHandler(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    
}