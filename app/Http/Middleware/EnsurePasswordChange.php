<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure user is authenticated
        if (auth()->check()) {
            $user = auth()->user();

            // Check if the user must change their password
            if ($user->must_change_passwd) {
                // Allow access only to profile-related routes
                if (!$request->is('admin/profile*')) {
                    return redirect()->route('profile.index')->with(
                        'warning',
                        'You must change your password before proceeding.'
                    );
                }
            }
        }

        return $next($request);
    }
}
