<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Admin Panel')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  @if(app()->getLocale()==='ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
  @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  @endif
  <style>
    .sidebar {width:240px;min-height:100vh}
    .sidebar .nav-link.active {background:#0d6efd;color:#fff;border-radius:.5rem}
    .sidebar .nav-link {color:#fff;opacity:.9}
    .sidebar .nav-link:hover {opacity:1}
  </style>
</head>
<body class="d-flex">
  <!-- Sidebar -->
  <aside class="sidebar bg-dark text-white p-3">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <a class="navbar-brand text-white fw-bold text-decoration-none" href="{{ route('admin.dashboard') }}">DermaClinic</a>
      <span class="badge text-bg-primary">{{ auth()->user()->getRoleNames()->first() }}</span>
    </div>

    @php($menu = config('admin_menu'))

    <ul class="nav flex-column gap-1">
      @foreach($menu as $item)
        @php
          $allowed = $item['can'] ? auth()->user()->can($item['can']) : true;
          $active  = is_active_menu($item['match'] ?? []);
        @endphp
        @if($allowed)
          <li class="nav-item">
            <a href="{{ route($item['route']) }}"
               class="nav-link {{ $active ? 'active' : 'text-white' }}">
              <span class="me-2">{{ $item['icon'] }}</span>
              <span>{{ __($item['label']) }}</span>
            </a>
          </li>
        @endif
      @endforeach
    </ul>

    <hr class="border-secondary my-4">

    <div class="small text-secondary mb-2">{{ __('Account') }}</div>
    <div class="d-grid gap-2">
      <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-light">{{ __('My Dashboard') }}</a>
      <form method="post" action="{{ route('logout') }}">@csrf
        <button class="btn btn-sm btn-outline-danger w-100">{{ __('Logout') }}</button>
      </form>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-grow-1 p-4 bg-body-tertiary">
    @yield('content')
  </main>
</body>
</html>
