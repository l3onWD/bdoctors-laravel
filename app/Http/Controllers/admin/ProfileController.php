<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Typology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $typologies = Typology::all();
        $profile_typology_id = $request->user()->profile->typologies->pluck('id')->toArray();

        return view('profile.edit', [
            'user' => $request->user(),
            'typologies' => $typologies,
            'profile_typology_id' => $profile_typology_id
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Get Data
        $data = $request->validated();
        $doctor = $request->user();
        $doctor_profile = $doctor->profile;

        // Handle toggle
        $data['is_visible'] = Arr::exists($data, 'is_visible');

        // Handle photo storing
        if (!Arr::exists($data, 'delete_photo') && Arr::exists($data, 'photo')) {
            // Delete old file
            if ($doctor_profile->photo) Storage::delete($doctor_profile->photo);

            // Store relative url
            $data['photo'] = Storage::putFile('profile_img', $data['photo']);
        }

        // Handle photo deleting
        if (Arr::exists($data, 'delete_photo') && $doctor_profile->photo) {
            Storage::delete($doctor_profile->photo);
            $data['photo'] = null;
        }


        // Update doctor fields
        $doctor->fill($data);

        // Update email
        if ($doctor->isDirty('email')) {
            $doctor->email_verified_at = null;
        }

        $doctor->save();


        // Update doctor profile fields
        $doctor_profile->update($data);


        // Update profile-typology records
        if (!Arr::exists($data, 'typologies') && count($doctor_profile->typologies)) $doctor_profile->typologies()->detach();
        else if (Arr::exists($data, 'typologies')) $doctor_profile->typologies()->sync($data['typologies']);


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $doctor = $request->user();

        Auth::logout();

        $doctor->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
