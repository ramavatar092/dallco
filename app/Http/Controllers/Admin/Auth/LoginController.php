<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AppAdmin;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('layouts.admin.auth.login');
    }

   public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $admin = AppAdmin::where('username', $request->username)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        Auth::guard('admin')->login($admin);

        $admin->update([
            'last_login' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        return redirect()->intended('/admin/dashboard');
    }

    return back()->withErrors([
        'username' => 'Invalid credentials',
    ])->withInput();
}


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
