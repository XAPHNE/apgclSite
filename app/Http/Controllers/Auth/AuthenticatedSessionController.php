<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\SendTwoFactorCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $key = 'login:' . $request->ip() . '|' . strtolower($request->input('email'));
        // Retrieve the lockout time from the session
        $lockoutTime = session('throttle_seconds', 0);  // Default to 0 if no session data

        $attemptsLeft = session('attempts_left', 3); // Default to 3

        return view('auth.login', compact('attemptsLeft', 'lockoutTime'));
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $request->user()->generateTwoFactorCode();

        $request->user()->notify(new SendTwoFactorCode());

        $user = $request->user();

        if ($user->hasRole('Tender Uploader')) {
            return redirect()->route('tenders.index'); // Redirect to Financial Years
        } elseif ($user->hasRole('Daily Generation Updater')) {
            return redirect()->route('daily-generation.index'); // Redirect to Daily Generation
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        RateLimiter::clear(strtolower($request->user()->email) . '|' . $request->ip());
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
