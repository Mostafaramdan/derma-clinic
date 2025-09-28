{{-- Dashboard Layout --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Dashboard')</title>

  {{-- لو عندك Vite --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  {{-- Bootstrap CSS (rtl/en) --}}
  @if(app()->getLocale()==='ar')
    <link rel="stylesheet" href="{{ url('css/bootstrap.rtl.min.css') }}">
  @else
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
  @endif

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="{{ url('css/bootstrap-icons.min.css') }}">

  @stack('styles')

  <style>
    .sidebar {
      width: 240px;
      min-height: 100vh;
      position: fixed;
      top: 0;
      z-index: 1040;
      overflow-y: auto;
      bottom: 0;
    }
    .sidebar .nav-link.active { background:#0d6efd; color:#fff; border-radius:.5rem }
    .sidebar .nav-link { color:#fff; opacity:.9 }
    .sidebar .nav-link:hover { opacity:1 }
    .main-content {
  padding-top: 70px; /* space for fixed navbar */
  min-height: 100vh;
  background: #f0f4fa;
  position: relative;
  z-index: 1;
    }
    @media (max-width: 768px) {
      .sidebar { display:none; }
      .main-content { margin:0 !important; }
    }
  </style>
</head>
<body class="bg-gray-100">
  @php
    $role = (auth()->check() && method_exists(auth()->user(), 'getRoleNames'))
              ? auth()->user()->getRoleNames()->first() : null;
    $menu = config('admin_menu', []);
    $localeAction = Route::has('locale.set') ? route('locale.set') : url('locale');
  @endphp

  @include('partials.navbar')

  {{-- Sidebar (واحد بس) --}}
  @php
    use Illuminate\Support\Facades\Route;
    $role = (auth()->check() && method_exists(auth()->user(), 'getRoleNames'))
              ? auth()->user()->getRoleNames()->first() : null;
    $menu = config('admin_menu', []);
    $localeAction = Route::has('locale.set') ? route('locale.set') : url('locale');
  @endphp

  <aside class="sidebar bg-dark text-white p-3" @if(app()->getLocale()==='ar') style="right:0; left:auto;" @else style="left:0; right:auto;" @endif>
    <div class="d-flex align-items-center justify-content-between mb-4">
      <a class="navbar-brand text-white fw-bold text-decoration-none" href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : '#' }}">
        DermaClinic
      </a>
      @if($role)
        <span class="badge text-bg-primary">{{ $role }}</span>
      @endif
    </div>

    <ul class="nav flex-column gap-1">
      @foreach((array) $menu as $item)
        @php
          $can       = $item['can']   ?? null;
          $routeName = $item['route'] ?? null;
          $icon      = $item['icon']  ?? '';
          $label     = $item['label'] ?? '';
          $match     = (array) ($item['match'] ?? []);

          $allowed = $can ? auth()->user()->can($can) : true;

          $active = function_exists('is_active_menu')
              ? is_active_menu($match)
              : in_array(Route::currentRouteName(), $match, true);

          $href = ($routeName && Route::has($routeName)) ? route($routeName) : '#';
        @endphp

        @if($allowed)
          <li class="nav-item">
            <a href="{{ $href }}" class="nav-link {{ $active ? 'active' : 'text-white' }}">
              <span class="me-2">{{ $icon }}</span>
              <span>{{ __($label) }}</span>
            </a>
          </li>
        @endif
      @endforeach
    </ul>

    <hr class="border-secondary my-4">

    <div class="small text-secondary mb-2">{{ __('Account') }}</div>
    <div class="d-grid gap-2">
      @if(Route::has('dashboard'))
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-light">{{ __('My Dashboard') }}</a>
      @endif
      <form method="POST" action="{{ route('logout') }}">@csrf
        <button class="btn btn-sm btn-outline-danger w-100">{{ __('Logout') }}</button>
      </form>
    </div>
  </aside>

  {{-- Main Content --}}
  <div class="main-content" @if(app()->getLocale()==='ar') style="margin-right:240px" @else style="margin-left:240px" @endif>
    @yield('content')
  </div>

  {{-- Bootstrap JS --}}
  <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>

  @stack('scripts')
</body>
</html>
