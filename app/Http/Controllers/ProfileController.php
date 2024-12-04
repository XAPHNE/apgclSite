<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function index(): View
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Validate current password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }
        }

        // Update user fields (name, email)
        $user->fill($request->only('name', 'email'));

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));

            // Reset the must_change_passwd flag when the password is updated
            $user->must_change_passwd = false;
        }

        // Update the updated_by field
        $user->updated_by = auth()->id();

        // Save changes
        $user->save();

        return Redirect::route('profile.index')->with('success', 'Profile updated successfully.');
    }
}