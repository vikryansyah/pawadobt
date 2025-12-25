<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        // Log attempt for debugging
        \Log::info('Login attempt', ['email' => $request->input('email'), 'remember' => $remember]);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            \Log::info('Login success', ['user_id' => Auth::id(), 'is_admin' => Auth::user()->is_admin]);

            // Cek apakah user adalah admin
            if (Auth::user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Berhasil masuk sebagai admin.');
            }

            return redirect()->intended(route('home'))->with('success', 'Berhasil masuk.');
        }

        \Log::warning('Login failed', ['email' => $request->input('email')]);

        return back()->withErrors([
            'email' => 'Kredensial tidak valid.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('Register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nama' => $data['name'], 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk dengan akun Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
