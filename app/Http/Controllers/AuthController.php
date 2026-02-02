<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); // Get the authenticated user

            // Example: Store user data in session
            session()->put('admin', $user);
    
            // Redirect to the dashboard
            return redirect()->route('dashboard');
        }
    
        // If authentication fails, return back with an error message
        return back()->with('message', 'Invalid email or password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');   
    }
}
