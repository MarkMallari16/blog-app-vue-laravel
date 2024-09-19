<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $user = Auth::user();
        $avatar = $user->avatar;

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'avatar' => $avatar
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updateAvatar(Request $request): RedirectResponse
    {

        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'], // Max size 2MB
        ]);

        $avatarPath = $request->file('avatar')->store('avatars', 'public');

        if ($request->user()->avatar && $request->user()->avatar !== 'avatar.png') {
            Storage::disk('public')->delete($request->user()->avatar);
        }

        // Update the user's avatar path in the database
        $request->user()->update([
            'avatar' => basename($avatarPath),
        ]);

        return Redirect::back();
    }
    public function destroyAvatar(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->avatar && $user->avatar !== 'avatar.png') {
            Storage::disk('public')->delete($user->avatar);

            $user->update([
                'avatar' => 'avatar.png'
            ]);
        }
        return Redirect::back();
    }
}
