<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi menu-icon mdi-chart-bar"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('persons.index') }}">
                <i class="mdi menu-icon mdi-account-multiple-plus-outline"></i>
                <span class="menu-title">Residents</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('business_permits.index') }}">
                <i class="mdi menu-icon mdi-newspaper"></i>
                <span class="menu-title">Business Permit</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cert_logs.index') }}">
                <i class="mdi menu-icon mdi-equal-box"></i>
                <span class="menu-title">Activity Logs</span>
            </a>
        </li>
   
        <li class="nav-item">
            <a class="nav-link" href="{{ route('baranagay_l_g_u_s.index') }}">
                <i class="mdi menu-icon mdi mdi-account-multiple-plus-outline"></i>
                <span class="menu-title">Councilor</span>
            </a>
        </li>

        <li class="nav-item nav-category">Blotter Record</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#blotter" aria-expanded="false" aria-controls="blotter">
                <i class="menu-icon mdi mdi-folder-outline"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blotter">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('blotters.index') }}">Blotter
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('people.index') }}">Person
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Account Center</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user_infos.index') }}">
                <i class="mdi menu-icon mdi-account"></i>
                <span class="menu-title">Account</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user_infos.index') }}">Users
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('trackings.index') }}">Login History
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}


    </ul>
</nav>
