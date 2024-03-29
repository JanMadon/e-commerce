<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{

    public function setAddress(Request $request)
    {

        
        $request->validate([
            'phone' => ['required', 'integer','digits:9'],
            'street' => ['required', 'string', 'min:3', 'max:20'],
            'building' => ['required', 'integer',],
            'zipCode' => ['required', 'regex:/^[0-9]{2}-[0-9]{3}$/'],
            'city' => ['required', 'string', 'min:3', 'max:20']
        ]);
        
        
        $address = Auth::user()->address;
         
        $address->update(
            [
                'phone' => $request->phone,
                'street' => $request->street,
                'building' => $request->building,
                'zipCode' => $request->zipCode,
                'city' => $request->city
            ]
        );

        return redirect()->back();
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
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

        return Redirect::route('profile.edit');
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
}
