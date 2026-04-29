<nav class="sidebar">


  <div class="sidebar-header" style="background-color: white;">

    <a href="#" class="sidebar-brand" style="padding-left:50px;">
      <img src="{{ asset('assets/images/others/Finance Advisory Logo Design (1).png') }}"
        style="width:100%;height:55px; margin-left:-25px;" alt="user.png">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body" style="
      background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%);
      min-height: 100vh;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding-top: 20px;
  ">

    <ul class="nav" style="list-style: none; padding: 0; margin: 0;">

      {{-- DASHBOARD --}}
      <li class="nav-item mb-1">
        <a href="{{ url('dashboard') }}" class="nav-link {{ active_class(['dashboard.index']) }}"
          style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; transition:0.3s; text-decoration:none; color:white;">
          <span class="bg-white rounded-circle text-center"
            style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-home" style="font-size:14px;"></i>
          </span>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      {{-- USERS --}}
      @can('view user')
        <li class="nav-item mb-1">
          <a href="{{ route('users.index') }}"
            class="nav-link {{ active_class(['users.index', 'users.create', 'users.edit']) }}"
            style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; transition:0.3s; text-decoration:none; color:white;">
            <span class="bg-white rounded-circle text-center"
              style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
              <i class="fa-solid fa-users" style="font-size:17px;"></i>
            </span>
            <span class="link-title">User</span>
          </a>
        </li>
      @endcan

      {{-- CATEGORY --}}
      @can('view category')
        <li class="nav-item mb-1">
          <a href="{{ route('category.index') }}"
            class="nav-link {{ active_class(['category.index', 'category.create', 'category.edit']) }}"
            style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; transition:0.3s; text-decoration:none; color:white;">
            <span class="bg-white rounded-circle text-center"
              style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
              <i class="fa-solid fa-folder" style="font-size:17px;"></i>
            </span>
            <span class="link-title">Category</span>
          </a>
        </li>
      @endcan

      {{-- SUBCATEGORY --}}
      @can('view subcategory')
        <li class="nav-item mb-1">
          <a href="{{ route('subcategory.index') }}"
            class="nav-link {{ active_class(['subcategory.index', 'subcategory.create', 'subcategory.edit']) }}"
            style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; transition:0.3s; text-decoration:none; color:white;">
            <span class="bg-white rounded-circle text-center"
              style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
              <i class="fa-solid fa-tags" style="font-size:17px;"></i>
            </span>
            <span class="link-title">SubCategory</span>
          </a>
        </li>
      @endcan

      {{-- BLOGS --}}
      @can('view posts')
        <li class="nav-item mb-1">
          <a href="{{ route('blogs.index') }}"
            class="nav-link {{ active_class(['blogs.index', 'blogs.create', 'blogs.edit']) }}"
            style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; transition:0.3s; text-decoration:none; color:white;">
            <span class="bg-white rounded-circle text-center"
              style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
              <i class="fa-solid fa-file-alt" style="font-size:17px;"></i>
            </span>
            <span class="link-title">Blog</span>
          </a>
        </li>
      @endcan

      {{-- SUBSCRIPTION --}}
      @can('view subscriptions')
        <li class="nav-item mb-1">
          <a href="{{ route('subscriptions.index') }}"
            class="nav-link {{ active_class(['subscriptions.index', 'subscriptions.create', 'subscriptions.edit']) }}"
            style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; transition:0.3s; text-decoration:none; color:white;">
            <span class="bg-white rounded-circle text-center"
              style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
              <i class="fa-solid fa-crown" style="font-size:17px;"></i>
            </span>
            <span class="link-title">Subscription</span>
          </a>
        </li>
      @endcan
      
      {{-- User side Subscription --}}

        @php
          use App\Models\UserSubscription;
          $user = auth()->user();
          $hasSubscription = UserSubscription::where('user_id', auth()->id())->exists();
          $userSubscriptionRoute = $hasSubscription
              ? route('user.subscription.table')
              : route('usersubscriptions.index');
      @endphp

      @can('view posts')
          @if($user->user_type !== 'superAdmin')
              <li class="nav-item">
                  <a href="{{ $userSubscriptionRoute }}" 
                    class="nav-link {{ active_class(['usersubscriptions.index', 'user.subscription.table','subscriptions.upgrade']) }}"
                    style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; transition:0.3s; text-decoration:none; color:white;">
                      <span class="bg-white rounded-circle text-center" style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
                          <i class="fa-solid fa-crown" style="width:17px;height:17px;"></i>
                      </span>
                      <span class="link-title side-bar-span">Subscription</span>
                  </a>
              </li>
          @endif
      @endcan


      {{-- ROLES --}}
      @can('view role')
        <li class="nav-item mb-1">
          <a href="{{ route('roles.index') }}"
            class="nav-link {{ active_class(['roles.index', 'roles.create', 'roles.edit']) }}"
            style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; transition:0.3s; text-decoration:none; color:white;">
            <span class="bg-white rounded-circle text-center"
              style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
              <i class="fas fa-user-shield" style="font-size:17px;"></i>
            </span>
            <span class="link-title">Role</span>
          </a>
        </li>
      @endcan

      {{-- LOGOUT --}}
      <li class="nav-item nav-link1 mt-auto  mb-1">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="nav-link mb-2"
            style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:10px; background:none; border:none; cursor:pointer; color:white;">
            <span class="bg-white rounded-circle text-center"
              style="width:30px;height:30px; display:flex; align-items:center; justify-content:center;">
              <i class="fas fa-sign-out-alt" style="font-size:17px;"></i>
            </span>
            <span class="link-title">Logout</span>
          </button>
        </form>
      </li>

    </ul>

  </div>

  <style>
    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
    }
    .nav-link1:hover {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
    }

    .nav-link.active {
      background-color: rgba(255, 255, 255, 0.3) !important;

      color: #fff;
      font-weight: 600;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .nav-link i {
      color: #000;
    }
  </style>


</nav>