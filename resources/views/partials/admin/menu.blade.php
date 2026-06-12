
<!-- ========== Admin Left Sidebar Start ========== -->
<div class="leftside-menu menuitem-active">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard') }}" class="logo logo-light">
        <span class="logo-lg">SOILI Admin</span>
        <span class="logo-sm">SA</span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('dashboard') }}" class="logo logo-dark">
        <span class="logo-lg">SOILI Admin</span>
        <span class="logo-sm">SA</span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarRequest" aria-expanded="false" aria-controls="sidebarRequest" class="side-nav-link">
                    <i class="uil-envelope"></i>
                    <span>Farmer Requests</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarRequest">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('farmer_requests.index') }}" class="side-nav-link">
                                <i class="uil-list-ul"></i>
                                <span>View Requests</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('farmer_requests.add_request') }}" class="side-nav-link">
                                <i class="uil-plus-circle"></i>
                                <span>Create Request</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarResults" aria-expanded="false" aria-controls="sidebarResults" class="side-nav-link">
                    <i class="uil-chart-bar"></i>
                    <span>Soil Results</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarResults">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('soil_sample_results.index') }}" class="side-nav-link">
                                <i class="uil-flask"></i>
                                <span>Soil Analysis</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('recommendation.index') }}" class="side-nav-link">
                                <i class="uil-file-check-alt"></i>
                                <span>Recommendations</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('farmers.index') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span>Farmers</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('users.index') }}" class="side-nav-link">
                    <i class="uil-user-circle"></i>
                    <span>System Users</span>
                </a>
            </li>

        </ul>

        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Admin Left Sidebar End ========== -->
