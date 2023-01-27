<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignUpController extends Controller
{
    //signup
    public function signup()
    {
        return view('signup');
    }
    // signup user
    public function auth_signup(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'confirm_password' => 'required_with:password|same:password|min:6',
            ]);

            // Creating user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'User created successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
