<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // Display the login view.
    
    public function create(): View
    {
        return view('auth.login');
    }

     //authentication request.
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

   
    $user = auth()->user();
    
    if ($user->status == 'nonaktif') {

    Auth::logout();

    return back()->withErrors([
        'email' => 'Akun anda dinonaktifkan admin.'
    ]);

}

    if ($user->role_id == 1) {
        return redirect('/superadmin');
    }

    if ($user->role_id == 2) {
        return redirect('/admin');
    }

    return redirect()->route('home'); // user biasa
}

     //Destroy an authenticated session.
   
public function destroy(Request $request): RedirectResponse
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}
