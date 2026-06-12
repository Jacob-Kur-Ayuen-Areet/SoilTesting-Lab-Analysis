<!-- ========== Farmer Topbar Start ========== -->
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-notification-3-line font-22"></i>
                    <span class="noti-icon-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 font-16 fw-semibold"> Notifications</h6>
                            </div>
                            <div class="col-auto">
                                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                    <small>Clear All</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="px-3" style="max-height: 300px;" data-simplebar>
                        <h5 class="text-muted font-13 fw-normal mt-2">No new notifications</h5>
                    </div>
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top py-2">
                        View All
                    </a>
                </div>
            </li>

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left" title="Theme Mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li>

            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="#" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line font-22"></i>
                </a>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" width="32" class="rounded-circle">
                    </span>
                    <span class="d-lg-flex flex-column gap-1 d-none">
                        <h5 class="my-0">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h5>
                        <h6 class="my-0 fw-normal text-muted">Farmer</h6>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}!</h6>
                    </div>

                    <a href="{{ route('farmer.profile') }}" class="dropdown-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span>My Profile</span>
                    </a>

                    <a href="{{ route('farmer.profile.edit') }}" class="dropdown-item">
                        <i class="mdi mdi-account-edit me-1"></i>
                        <span>Edit Profile</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="mdi mdi-logout me-1"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Farmer Topbar End ========== -->
