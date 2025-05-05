<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->is('logout') || $request->session()->has('just_logged_out')) {
            return view('usermain');
        }
        
        if (Auth::check()) {
            $user = Auth::user();
            $userRole = $user->role; 
            
            if ($userRole === 'admin') {
                return redirect()->route('admin.home');
            } elseif ($userRole === 'pengelola') {
                return redirect()->to('/laporan');
            }
        }
        
        return view('usermain');
    }
}