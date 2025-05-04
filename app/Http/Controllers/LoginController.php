<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('auth.forms.login');
    }
    function check()
    {
        $credentials = request()->validate([
            'univEmail' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/'); 
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Redirect to a desired route after logout
    }
}
