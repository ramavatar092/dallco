<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('layouts.admin.auth.login');
    }

    /**
     * Handle the admin login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login using 'admin' guard (configure this in config/auth.php)
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $admin = Auth::guard('web')->user();
    
            // Update login metadata
            $admin->update([
                'last_login' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            return redirect()->route('dashboard');
        }

        throw ValidationException::withMessages([
            'username' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Logout the admin.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
