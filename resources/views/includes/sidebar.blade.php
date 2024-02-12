{{-- Sidebar Overlay --}}
<div class="app-sidebar-overlay"></div>

{{-- Sidebar --}}
<nav class="app-sidebar">
    <ul class="app-sidebar-menu">

        {{-- Guest Links --}}
        <li>
            <a href="http://localhost:5174/" class="@if (Route::is('guest.home')) active @endif">
                <i class="fas fa-home fa-lg fa-fw"></i>
                <span class="fw-bold ms-1">{{ __('Home') }}</span>
            </a>
        </li>
        @auth
            {{-- AuthLinks --}}
            <li>
                <a href="{{ route('admin.home') }}" class="@if (Route::is('admin.home')) active @endif">
                    <i class="fas fa-border-all fa-lg fa-fw"></i>
                    <span class="ms-1">{{ __('Dashboard') }}</span>
                </a>
            </li>
        @endauth

    </ul>
</nav>

{{-- Sidebar Toggler --}}
<button class="app-sidebar-toggler btn btn-primary">
    <i class="fas fa-angle-right fa-xl"></i>
</button>
