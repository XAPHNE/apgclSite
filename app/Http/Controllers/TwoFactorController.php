<?php

namespace App\Http\Controllers;

use App\Notifications\SendTwoFactorCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TwoFactorController extends Controller
{
    public function index(): View
    {
        return view('auth.twoFactor');
    }
    public function store(Request $request): ValidationException|RedirectResponse
    {
        $request->validate([
            'two_factor_code' => ['integer', 'required'],
        ]);
        $user = auth()->user();
        if ($request->input('two_factor_code') !== $user->two_factor_code) {
            throw ValidationException::withMessages([
                'two_factor_code' => __("The code you entered doesn't match our records"),
            ]);
        }
        $user->resetTwoFactorCode();
        return redirect()->to($this->getRedirectPath($user));
    }
    /**
     * Determine the correct redirect path based on the user role.
     */
    protected function getRedirectPath($user): string
    {
        if ($user->hasRole('Tender Uploader')) {
            return route('tenders.index');
        } elseif ($user->hasRole('Daily Generation Updater')) {
            return route('daily-generation.index');
        }

        return RouteServiceProvider::HOME;
    }
    
    public function resend(): RedirectResponse
    {
        $user = auth()->user();
        // Skip OTP generation and email sending for admin email
        if ($user->email === 'admin@apgcl.org') {
            return redirect()->back()->withStatus(__('Admin does not require OTP.'));
        }
        $user->generateTwoFactorCode();
        $user->notify(new SendTwoFactorCode());
        return redirect()->back()->withStatus(__('Code has been sent again'));
    }
}
