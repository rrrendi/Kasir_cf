<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (! Auth::attempt($credentials)) {
    return back()->with('error', 'Email atau password salah.');
}


    $request->session()->regenerate();

    // Redirect sesuai role
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->role === 'kasir') {
        return redirect()->route('kasir.dashboard');
    }

    Auth::logout();
    return redirect('/login')->withErrors([
        'email' => 'Role pengguna tidak valid.',
    ]);
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
