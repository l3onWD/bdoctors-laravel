@extends('layouts.app')

@section('content')
    <section class="container-fluid bg-light py-5 py-lg-4">

        <h2 class="fs-4 text-secondary mb-4">
            {{ __('Dashboard') }}
        </h2>

        {{-- Content --}}
        <div class="row">

            {{-- Main Column --}}
            <div class="col-12 mb-3">
                <div class="card profile-card bg-white pb-3">

                    {{-- Profile Banner --}}
                    <div class="profile-card-banner">
                    </div>

                    {{-- Profile Photo --}}
                    <img src="{{ $doctor->profile->photo ? $doctor->profile->getPhotoPath() : asset('img/profile-placeholder.png') }}"
                        alt="Profile Photo" class="profile-card-photo">

                    {{-- Card Body --}}
                    <div class="profile-card-body px-3 mb-3">

                        {{-- Avg Valutations --}}
                        <div class="d-flex text-warning mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-star fa-lg @if ($doctor->profile->stars->avg('vote') >= $i) fas @else far @endif"></i>
                            @endfor
                        </div>

                        <h2>{{ $doctor->getFullName() }}</h2>
                        <p>{{ $doctor->profile->address }}</p>
                        <p>{{ $doctor->profile->description }}</p>

                    </div>

                    {{-- Card Actions --}}
                    <div class="px-3">
                        <a href="{{ url('profile') }}" class="btn btn-outline-primary">Edita Profilo</a>
                    </div>

                </div>
            </div>

            {{-- Details Column --}}
            <div class="col-12">
                <div class="card bg-white p-2">
                    <h4>Specializzazioni</h4>
                    <ul>
                        @foreach ($doctor->profile->typologies as $typology)
                            <li>{{ $typology->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </section>
@endsection
