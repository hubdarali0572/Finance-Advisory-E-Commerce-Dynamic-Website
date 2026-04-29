@php
  $user = auth()->user();
  $profilePath = $user && $user->profile_photo ? public_path('userimages/' . $user->profile_photo) : null;
  $profileUrl  = ($profilePath && file_exists($profilePath))
                 ? asset('userimages/' . $user->profile_photo)
                 : asset('assets/images/others/dummy.png');
@endphp

<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">

          <img class="wd-40 ht-40 rounded-circle" src="{{ $profileUrl }}" alt="{{ $user? $user->name : 'User' }}">

        </a>

        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              <img class="wd-80 ht-80 rounded-circle" src="{{ $profileUrl }}" alt="{{ $user? $user->name : 'User' }}">
            </div>
            <div class="text-center">
              <p class="tx-16 fw-bolder">{{ $user ? $user->name : 'Guest' }}</p>
            </div>
          </div>

          <ul class="list-unstyled p-1">
            <li class="dropdown-item py-2">
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn text-body ms-0">
                  <i class="me-2 icon-md" data-feather="log-out"></i>
                  <span>Log Out</span>
                </button>
              </form>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>
