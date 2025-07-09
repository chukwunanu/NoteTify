<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.sign-in');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)],
        ]);

        // Attempt to log in the user
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
                'password' => 'The provided credentials does not match our records.'
            ]);
        }
        request()->session()->regenerate();

        return redirect()->route('user.index')->with('message', 'Login Successful!');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        return redirect()->route('login.index')->with('success', 'Logged out successfully!');
    }
}
