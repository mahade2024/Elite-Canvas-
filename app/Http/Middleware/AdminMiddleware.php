<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in AND if their role is 1 (Admin)
        if (!Session::has('user') || Session::get('user')['role'] != 1) {
            // If not admin, kick them back to home page
            return redirect('/')->with('error', 'Access Denied! Admins only.');
        }

        return $next($request);
    }
    public function showClothingProducts() {
    $products = \App\Models\Product::where('category', 'clothing')->get();
    return view('admin.clothingadminproducts', ['products' => $products]);
}
}

