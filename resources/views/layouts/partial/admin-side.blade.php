<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item nav-category">Resident Management</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#services" aria-expanded="false"
                aria-controls="services">
                <i class="menu-icon mdi mdi-account-multiple-plus-outline"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="services">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('persons.index') }}">Residents</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Clerance Management</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#clearance" aria-expanded="false"
                aria-controls="clearance">
                <i class="menu-icon mdi mdi-comment-check"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="clearance">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('business_permits.index') }}">Business
                            Permit</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Elected Council</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#lgus" aria-expanded="false" aria-controls="lgus">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="lgus">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('baranagay_l_g_u_s.index') }}">Council
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Login Tracking</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#track" aria-expanded="false" aria-controls="track">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="track">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('trackings.index') }}">Activity
                        </a>
                    </li>
                </ul>
            </div>
        </li>


    </ul>
</nav>