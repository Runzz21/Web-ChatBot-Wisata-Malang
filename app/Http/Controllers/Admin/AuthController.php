<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('admin.auth.login');
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $admin = Admin::where('username', $request->input('username'))->first();

        if (!$admin || !password_verify($request->input('password'), $admin->password_hash)) {
            return back()
                ->withInput()
                ->withErrors(['username' => 'Username atau password salah.']);
        }

        $request->session()->regenerate();
        session(['admin_id' => $admin->id_admin, 'admin_username' => $admin->username]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Selamat datang, ' . $admin->username . '!');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_id', 'admin_username']);
        $request->session()->regenerate();

        return redirect()->route('admin.login')
            ->with('success', 'Anda berhasil logout.');
    }
}
