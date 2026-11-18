<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // --- LOGIN LOGIC ---
    function login(Request $req)
    {
        $user = User::where(['email' => $req->email])->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return redirect('/login')->with('error', 'Username or password is not matched');
        }

        $req->session()->put('user', $user);

        // Sync session cart to database after login
        if (Session::has('cart')) {
            $sessionCart = Session::get('cart'); 
            foreach ($sessionCart as $productId) {
                $exists = Cart::where('user_id', $user->id)->where('product_id', $productId)->exists();
                if (!$exists) {
                    $cart = new Cart;
                    $cart->user_id = $user->id;
                    $cart->product_id = $productId;
                    $cart->save();
                }
            }
            Session::forget('cart');
        }
        
        // --- SMART REDIRECT ---
        if ($user->role == 1) {
            return redirect('/admin/orders'); // Changed to match your orders panel
        }

        return redirect('/');
    }

    // --- SIGNUP LOGIC (CLEANED) ---
    function register(Request $req)
    {
        // Validation ensures emails aren't duplicated in DB
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3'
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->role = 0; // Hardcoded to Client for security
        $user->save();

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

    // --- LOGOUT LOGIC ---
    function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }
}