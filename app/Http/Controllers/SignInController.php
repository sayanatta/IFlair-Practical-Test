<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{ //signin
    public function signin()
    {
        return view('signin');
    }
    // signup user
    public function auth_signin(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard')->with('success', 'Signin successfully!');
            }
            return redirect()->back()->with('error', 'User credentials not currect!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('welcome')->with('success', 'Logout successfully!');
    }
}
