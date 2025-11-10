<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
<<<<<<< HEAD
        // Check if user exists
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak ditemukan. Silakan periksa email Anda.'
                ], 401);
            }
            return back()->withErrors(['email' => 'Akun tidak ditemukan.'])->withInput();
        }
    
=======
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
<<<<<<< HEAD
            $redirectUrl = $user->role_id === 1 ? '/dashboard/admin' : '/';
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'redirect' => $redirectUrl
                ]);
            }
            
            return redirect()->intended($redirectUrl);
        }
    
        // Password is wrong
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah. Silakan coba lagi.'
            ], 401);
        }
        
        return back()->withErrors(['password' => 'Password salah.'])->withInput();
=======
            if ($user->role_id === 1) { 
                return redirect()->intended('/dashboard/admin');
            } elseif ($user->role_id === 2) { 
                return redirect()->intended('/');
            }
        }
    
        return back()->with('loginError', 'Masukkan Email & Password Dengan Benar');
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
