<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function home()
    {
        $users = User::count();
        return view('welcome', compact('users'));
    }
    //
    public function dashboard()
    {
        $categories = Category::user()->count();
        $products = Product::user()->count();
        return view('dashboard', compact('categories', 'products'));
    }
}
