<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
    
        if (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
    
            // Simpan waktu login
            $now = now(); 
            UserSession::create([
                'user_id' => Auth::id(),
                'login_time' => $now,
            ]);
    
            return redirect()->intended('/dashboard');
        }
    
        return back()->with('loginError', 'Login Gagal!');
    }
    public function logout(Request $request)
    {
        // Mendapatkan pengguna yang saat ini diautentikasi
        $user = Auth::user();
    
        // Mendapatkan sesi terakhir pengguna yang masih aktif
        $session = UserSession::where('user_id', $user->id)
                        ->whereNull('logout_time')
                        ->latest()
                        ->first();
    
        // Memperbarui logout_time dengan waktu sekarang
        if ($session) {
            $session->update(['logout_time' => Carbon::now()]);
        }
    
        // Logout pengguna dari aplikasi
        Auth::logout();
    
        // Mematikan sesi saat ini dan meregenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
    
}
