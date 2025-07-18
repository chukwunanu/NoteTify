<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

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

        if (session()->has('invite_token')) {
            $token = session('invite_token');
            $invitation = Invite::where('token', $token)
                ->where('email', $attributes['email'])
                ->where('accepted', false)
                ->first();
            
            if ($invitation) {
                $user = Auth::user();
                $user->teams->attach($invitation->team_id);
                $invitation->update(['accepted' => true]);
            }
        
            session()->forget('invite_token');
        }
        
        request()->session()->regenerate();

        return redirect()->route('user.index')->with('success', 'Login Successful!');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
