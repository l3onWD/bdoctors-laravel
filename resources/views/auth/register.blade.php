@extends('layouts.app')

@section('content')
    <section class="container py-5 py-lg-4">

        {{-- Content --}}
        <div class="row justify-content-center">

            {{-- Main Form --}}
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
                            @csrf

                            {{-- First Name --}}
                            <div class="mb-4 row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" required autocomplete="name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- Last Name --}}
                            <div class="mb-4 row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Last Name') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" required autocomplete="name">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- Email --}}
                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- Password --}}
                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- Confirm Password --}}
                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>


                            {{-- Address --}}
                            <div class="mb-4 row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Address') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address-level1">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            {{-- Typologies --}}
                            <div class="mb-4">
                                <p class="mb-2">
                                    {{ __('Typologies') }}
                                    <span class="text-danger">*</span>
                                </p>

                                <div class="border rounded p-1 @error('typologies') border-danger @enderror">
                                    <div class="row">
                                        @foreach ($typologies as $typology)
                                            <div class="col-6 col-lg-4 d-flex gap-2 mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    @if (in_array($typology->id, old('typologies', []))) checked @endif
                                                    id="typology-{{ $typology->id }}" value="{{ $typology->id }}"
                                                    name="typologies[]">
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
                                        name="description">{{ old('description') }}</textarea>

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
                                    <textarea id="services" type="text" class="form-control @error('services') is-invalid @enderror"
                                        name="services">{{ old('services') }}</textarea>

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
                                    <div class="input-group file-change d-none">
                                        <button class="btn btn-outline-secondary" type="button">Change Photo</button>
                                        <input type="text" class="form-control" disabled>
                                    </div>

                                    {{-- Input for add photo --}}
                                    <input type="file"
                                        class="form-control file-input @error('photo') is-invalid @enderror"
                                        id="photo" name="photo">

                                    @error('photo')
                                        <span class="invalid-feedback error-message"
                                            role="alert">{{ $message }}</span>
                                    @enderror
                                    <span id="photo-error" class="error-message"></span>

                                    {{-- Button for remove photo --}}
                                    <button class="btn btn-danger mt-3 file-remove d-none" type="button">Remove
                                        Photo</button>
                                    <input type="checkbox" class="d-none file-delete" name="delete_photo"
                                        value="1">
                                </div>

                                {{-- # Preview --}}
                                <div class="col-12 col-sm-4 col-lg-2">
                                    <img src="/img/profile-placeholder.png" alt="preview"
                                        class="img-fluid image-preview">
                                </div>

                            </div>


                            {{-- Actions --}}
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

@section('scripts')
    @vite(['resources/js/file-uploader.js'])
@endsection
