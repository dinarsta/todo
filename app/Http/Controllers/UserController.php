<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login dengan user_id
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_id' => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('tasks.index');
        }

        return back()->withErrors([
            'user_id' => 'ID atau password salah.',
        ]);
    }

    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => 'user' // Default role
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
