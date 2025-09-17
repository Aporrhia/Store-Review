<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check if user has level 2 (admin level)
            if ($user->level != 2) {
                // Log out the user and redirect with error
                Auth::logout();
                
                return redirect('/admin/login')->withErrors([
                    'email' => 'Access denied. You do not have administrator privileges.'
                ]);
            }
        }

        return $next($request);
    }
}