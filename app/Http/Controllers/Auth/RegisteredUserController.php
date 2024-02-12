<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Typology;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        $typologies = Typology::orderBy('name')->get();

        return view('auth.register', compact('typologies'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validations
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'typologies' => 'required|exists:typologies,id',

            'description' => 'nullable|string',
            'services' => 'nullable|string',
            'photo' => 'nullable|image:jpg, jpeg, png, svg, webp, pdf',
            'is_visible' => 'nullable|boolean',
        ]);

        // Handle toggle
        $data['is_visible'] = Arr::exists($data, 'is_visible');

        // Store photo
        if (array_key_exists('photo', $data)) {
            $img_url = Storage::putFile('profile_img', $data['photo']);
            $data['photo'] = $img_url;
        }


        // Create and login user
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);


        // Create profile
        $doctor_profile = Profile::create([
            'user_id' => $user->id,
            'address' => $data['address'],
            'description' => $data['description'] ?? '',
            'services' => $data['services'] ?? '',
            'photo' => $data['photo'] ?? '',
        ]);


        // Insert profile-typology records
        if (Arr::exists($data, 'typologies')) $doctor_profile->typologies()->attach($data['typologies']);


        return redirect(RouteServiceProvider::HOME);
    }
}
