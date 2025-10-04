{{-- Unified Top Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top" style="border-bottom:1px solid #eee; z-index:1050;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2"
       href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : route('dashboard') }}" style="font-size:1.4em;">
      <i class="bi bi-hospital"></i> {{ config('app.name', 'Dashboard') }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0 align-items-center gap-2">
        <li class="nav-item">
          <a class="nav-link position-relative" href="#" title="Notifications">
            <i class="bi bi-bell" style="font-size:1.3em;"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.7em;">3</span>
          </a>
        </li>
        <li class="nav-item d-flex align-items-center gap-2">
          <form method="POST" action="{{ route('locale.set') }}" id="lang-switch-form" class="m-0 p-0">
            @csrf
            <input type="hidden" name="locale" value="{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}">
            <button type="submit"
              class="btn btn-sm px-3 py-1 border rounded-pill fw-bold shadow-sm"
              style="background: #f4f6fa; color: #2563eb; font-size:1em; min-width:70px; transition: background 0.2s, color 0.2s;"
              onmouseover="this.style.background='#2563eb';this.style.color='#fff'"
              onmouseout="this.style.background='#f4f6fa';this.style.color='#2563eb'"
            >
                {{ app()->getLocale() === 'ar' ? __('messages.navbar.english') : __('messages.navbar.arabic') }}
            </button>
          </form>
          <div class="dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="profileDropdown"
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=2563eb&color=fff&size=36"
                   alt="avatar" class="rounded-circle border me-2" width="36" height="36">
              <span class="fw-bold text-dark">{{ auth()->user()->name ?? '' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              @if(Route::has('profile.edit'))
                  <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> {{ __('messages.navbar.profile') }}</a></li>
                <li><hr class="dropdown-divider"></li>
              @endif
              <li>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">
                      <i class="bi bi-box-arrow-right"></i> {{ __('messages.navbar.logout') }}
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
