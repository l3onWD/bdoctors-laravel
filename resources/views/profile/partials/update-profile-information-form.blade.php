<section>
    {{-- Section header --}}
    <header>
        <h2 class="text-secondary">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')


        {{-- First Name --}}
        <div class="mb-2">
            <label for="first_name">{{ __('First Name') }}<span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="first_name" id="first_name" autocomplete="name"
                value="{{ old('first_name', $user->first_name) }}" required autofocus>
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Last Name --}}
        <div class="mb-2">
            <label for="last_name">{{ __('Last Name') }}<span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="last_name" id="last_name" autocomplete="name"
                value="{{ old('last_name', $user->last_name) }}" required>
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Email --}}
        <div class="mb-2">
            <label for="email">
                {{ __('Email') }}
                <span class="text-danger">*</span>
            </label>

            <input id="email" name="email" type="email" class="form-control"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />

            @error('email')
                <span class="alert alert-danger mt-2" role="alert">
                    <strong>{{ $errors->get('email') }}</strong>
                </span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-muted">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-outline-dark">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>


        {{-- Address --}}
        <div class="mb-2">
            <label for="address">{{ __('Address') }}<span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="address" id="address" autocomplete="address-level1"
                value="{{ old('address', $user->profile->address) }}" required>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Typologies --}}
        <div class="mb-2">
            <label for="typologies">{{ __('Typologies') }}<span class="text-danger">*</span></label>
            <div class="border rounded p-1 @error('typologies') border-danger @enderror">
                <div class="row">
                    @foreach ($typologies as $typology)
                        <div class="col-6 col-lg-4 d-flex gap-2 mb-2">
                            <input class="form-check-input" type="checkbox"
                                @if (in_array($typology->id, old('typologies', $profile_typology_id ?? []))) checked @endif id="typology-{{ $typology->id }}"
                                value="{{ $typology->id }}" name="typologies[]">
                            <label class="form-check-label me-3"
                                for="typology-{{ $typology->id }}">{{ $typology->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('typologies')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Nullables Info --}}
        <hr class="mb-4">


        {{-- Description --}}
        <div class="mb-4 row">
            <label for="description" class="col-md-4 col-form-label text-md-right">
                {{ __('Description') }}
            </label>

            <div class="col-md-6">
                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                    name="description">{{ old('description', $user->profile->description) }}</textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        {{-- Services --}}
        <div class="mb-4 row">
            <label for="services" class="col-md-4 col-form-label text-md-right">
                {{ __('Services') }}
            </label>

            <div class="col-md-6">
                <textarea id="services" type="text" class="form-control @error('services') is-invalid @enderror" name="services">{{ old('services', $user->profile->services) }}</textarea>

                @error('services')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        {{-- Photo --}}
        <div class="row file-uploader mb-4">

            {{-- # Add file --}}
            <div class="col-12 col-sm-8 col-lg-10 mb-3">

                <label for="photo" class="form-label fs-5">Photo</label>

                {{-- Button for change photo --}}
                <div class="input-group file-change  @if (!$user->profile->photo) d-none @endif">
                    <button class="btn btn-outline-secondary" type="button">Change Photo</button>
                    <input type="text" class="form-control" placeholder="{{ $user->profile->photo }}" disabled>
                </div>

                {{-- Input for add photo --}}
                <input type="file"
                    class="form-control file-input @error('photo') is-invalid @enderror @if ($user->profile->photo) d-none @endif"
                    id="photo" name="photo">

                @error('photo')
                    <span class="invalid-feedback error-message" role="alert">{{ $message }}</span>
                @enderror
                <span id="photo-error" class="error-message"></span>

                {{-- Button for remove photo --}}
                <button class="btn btn-danger mt-3 file-remove @if (!$user->profile->photo) d-none @endif"
                    type="button">Remove Photo</button>
                <input type="checkbox" class="d-none file-delete" name="delete_photo" value="1">
            </div>

            {{-- # Preview --}}
            <div class="col-12 col-sm-4 col-lg-2">
                <img src="{{ $user->profile->photo ? $user->profile->getPhotoPath() : '/img/profile-placeholder.png' }}"
                    alt="preview" class="img-fluid image-preview">
            </div>

        </div>


        {{-- Actions --}}
        <div class="d-flex align-items-center gap-4">
            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <script>
                    const show = true;
                    setTimeout(() => show = false, 2000)
                    const el = document.getElementById('profile-status')
                    if (show) {
                        el.style.display = 'block';
                    }
                </script>
                <p id='profile-status' class="fs-5 text-muted">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
