<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('admin_user_id')) {
            return redirect()->route('admin.login')->with('error', 'Please log in to access the admin dashboard.');
        }

        return $next($request);
    }
}
