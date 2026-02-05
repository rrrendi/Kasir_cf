<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials)) {
            // Ini yang membuat halaman refresh dengan pesan error jika password salah
            return back()->with('error', 'Email atau password salah.');
        }

        $request->session()->regenerate();

        // Cek Role & Redirect
        $role = auth()->user()->role;
        
        if ($role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($role === 'kasir') {
            return redirect()->intended(route('kasir.dashboard'));
        }

        // Jika role tidak dikenali, logout paksa
        Auth::logout();
        return redirect()->route('login')->with('error', 'Akun tidak memiliki akses yang valid.');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}