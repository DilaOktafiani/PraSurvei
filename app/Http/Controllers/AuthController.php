<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan model User di-import

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses pengecekan login (Dibuat Ketat / Case-Sensitive)
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // 1. Cari user secara manual dengan BINARY agar huruf besar/kecil dicek ketat
        $user = User::whereRaw('BINARY username = ?', [$request->username])->first();

        // 2. Cek apakah user ditemukan DAN password-nya cocok
        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            
            // Login-kan user secara manual
            Auth::login($user, true);
            
            $request->session()->regenerate();
            return redirect()->intended('/'); 
        }

        // 3. Jika gagal, kembalikan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}