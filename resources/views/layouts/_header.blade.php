<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#">DermaClinic</a>

    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <form method="post" action="{{ route('locale.set') }}" class="d-flex">
          @csrf
          <select name="locale" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="ar" @selected(app()->getLocale()==='ar')>العربية</option>
            <option value="en" @selected(app()->getLocale()==='en')>English</option>
          </select>
        </form>
      </li>
    </ul>
  </div>
</nav>
