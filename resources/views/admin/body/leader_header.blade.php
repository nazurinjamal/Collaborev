<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/reviewleader/dashboard" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png')}}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png')}}" alt="logo-dark" height="60">
                    </span>
                </a>

                <a href="/reviewleader/dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png')}}" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png')}}" alt="logo-light" height="60">
                    </span>
                </a>
            </div>

            
    
        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            @php

            $id = Auth::user()->id;
            $adminData = App\Models\User::find($id);

            @endphp
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ (!empty($adminData->profile_picture))? url('upload/admin_images/'.$adminData->profile_picture): url('upload/user.png') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{$adminData->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{route('admin.logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>