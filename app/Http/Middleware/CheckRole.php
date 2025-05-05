<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($role === 'guest') {
            // Kalau sudah login, redirect sesuai role
            if (Auth::check()) {
                return Auth::user()->role === 'admin'
                    ? redirect()->route('admin.home')
                    : redirect()->route('home');
            }

            else if (Auth::check()){
                return Auth::user()->role === 'pengelola'
                ? redirect()->route('laporan')
                : redirect()->route('laporan');
            }
    
            // Belum login, izinkan akses ke route guest (login/register)
            return $next($request);
        }
    
        // Kalau belum login dan bukan guest, redirect ke login
        if (!Auth::check()) {
            if ($role === 'admin') {
                return redirect()->route('auth.admin.login');
            }
    
            return redirect()->route('login');
        }
    
        // Jika sudah login tapi role tidak sesuai
        if (Auth::user()->role !== $role) {
            return redirect()->back();
        }
    
        return $next($request);
    }
}
