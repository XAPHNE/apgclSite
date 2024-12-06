<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Skip 2FA for specific user
        if (auth()->check() && $user->email === 'admin@apgcl.org') {
            return $next($request);
        }

        // Check if 2FA is required
        if (auth()->check() && $user->two_factor_code) {
            // If the 2FA code has expired, reset it, log out the user, and redirect to login
            if ($user->two_factor_expires_at < now()) {
                $user->resetTwoFactorCode();
                auth()->logout();
                return redirect()->route('login')
                    ->withStatus('Your verification code expired. Please re-login.');
            }
            // Redirect to the 2FA verification page if not already on it
            if (!$request->is('verify*')) {
                return redirect()->route('verify.index');
            }
        }
        return $next($request);
    }
}
