<aside id="sidebar" class="sidebar">


    <ul class="sidebar-menu">

        <li>
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @can('manage companies')
        <li>
            <a href="{{ route('companies.index') }}"
               class="{{ request()->routeIs('companies.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i>
                <span>Companies</span>
            </a>
        </li>
        @endcan

        <li>
            <a href="{{ route('products.index') }}"
               class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Products</span>
            </a>
        </li>

        <li>
            <a href="{{ route('test-parameters.index') }}"
               class="{{ request()->routeIs('test-parameters.*') ? 'active' : '' }}">
                <i class="bi bi-list-check"></i>
                <span>Test Parameters</span>
            </a>
        </li>

        <li>
            <a href="{{ route('samples.index') }}"
               class="{{ request()->routeIs('samples.*') ? 'active' : '' }}">
                <i class="bi bi-beaker"></i>
                <span>Samples</span>
            </a>
        </li>

        <li>
            <a href="{{ route('sample-tests.index') }}"
               class="{{ request()->routeIs('sample-tests.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-data"></i>
                <span>Sample Tests</span>
            </a>
        </li>

        @can('approve samples')
        <li>
            <a href="{{ route('qa.index') }}"
               class="{{ request()->routeIs('qa.*') ? 'active' : '' }}">
                <i class="bi bi-check-circle"></i>
                <span>QA Approval</span>
            </a>
        </li>
        @endcan

        @can('manage users')

        <li>
            <a href="{{ route('users.index') }}"
               class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Users</span>
            </a>
        </li>

        <li>
            <a href="{{ route('settings.index') }}"
               class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li>

        <li>
            <a href="{{ route('activity.index') }}"
               class="{{ request()->routeIs('activity.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span>Activity Logs</span>
            </a>
        </li>

        @endcan

    </ul>

</aside>