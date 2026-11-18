<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class UserAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        // If user is ALREADY logged in, don't let them see the login page
        if ($path == "login" && $request->session()->has('user')) {
            return redirect('/');
        }

        // We removed the redirect for "/" so guests can see the home page!
        return $next($request);
    }
}