<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited(); // Check if the user is already locked out

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            $key = $this->throttleKey();
            RateLimiter::hit($key, 86400); // Only count failed attempts (Expires in 24 hours)

            // Calculate attempts left (max 3)
            $attemptsLeft = max(3 - RateLimiter::attempts($key), 0);
            session(['attempts_left' => $attemptsLeft]);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        session()->forget('attempts_left');
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        $key = $this->throttleKey();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            event(new Lockout($this));

            // Get remaining time for lockout
            $seconds = RateLimiter::availableIn($key);

            // Store lockout time in session
            session(['throttle_seconds' => $seconds]);

            // Abort with 429 status code to prevent further login attempts
            abort(429);
        }

        // throw ValidationException::withMessages([
        //     'email' => trans('auth.throttle', [
        //         'seconds' => $seconds,
        //         'minutes' => ceil($seconds / 60),
        //     ]),
        // ]);
        // session(['throttle_seconds' => $seconds]);
        // abort(429);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        // return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
        return strtolower($this->input('email')) . '|' . $this->ip();
    }
}
