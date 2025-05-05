<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $request->session()->put('previous_role', Auth::user()->role);
            
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.home');
            }
            else if (Auth::user()->role == 'pengelola'){
                return redirect()->route('laporan');
            }
            
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
    Auth::logout();
    
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    $request->session()->flash('just_logged_out', true);
    
    return redirect('/');
    }
}