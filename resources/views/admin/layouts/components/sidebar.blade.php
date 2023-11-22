<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.welcome.index') }}">
            <span class="align-middle">MovieCMS</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Administrator
            </li>
            <li class="sidebar-item {{ request()->routeIs('cms.user-manager.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('cms.user-manager.index') }}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">User Manager</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('cms.role.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('cms.role.index') }}">
                    <i class="align-middle" data-feather="star"></i> <span class="align-middle">Role</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('cms.permission.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('cms.permission.index') }}">
                    <i class="align-middle" data-feather="lock"></i> <span class="align-middle">Permission</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('cms.media.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('cms.media.index') }}">
                    <i class="align-middle" data-feather="upload"></i> <span class="align-middle">Media</span>
                </a>
            </li>

            <li class="sidebar-header">
                Contents
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-buttons.html">
                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-forms.html">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-cards.html">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-typography.html">
                    <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="icons-feather.html">
                    <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                </a>
            </li>

            <li class="sidebar-header">
                Plugins & Addons
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                </div>
            </div>
        </div>
    </div>
</nav>
