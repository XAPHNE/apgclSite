<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Redirect user based on their role
                return redirect($this->getRedirectPath($user));
            }
        }

        return $next($request);
    }

    /**
     * Determine the redirect path based on user role.
     */
    protected function getRedirectPath($user): string
    {
        if ($user->hasRole('Tender Uploader')) {
            return route('tenders.index');
        } elseif ($user->hasRole('Daily Generation Updater')) {
            return route('daily-generation.index');
        } elseif ($user->hasRole('admin')) {
            return '/admin-dashboard';
        } elseif ($user->hasRole('manager')) {
            return '/manager-dashboard';
        }

        return RouteServiceProvider::HOME; // Default redirection
    }
}
