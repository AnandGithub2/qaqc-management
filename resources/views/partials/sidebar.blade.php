<aside id="sidebar" class="sidebar">

    <div class="sidebar-header text-center py-3">

        <i class="bi bi-shield-check fs-1 text-warning"></i>

        <h5 class="mt-2 mb-0 text-white">
            QA/QC ERP
        </h5>

        <small class="text-light">

            {{ auth()->user()->name }}

        </small>

        <br>

        @if(auth()->user()->hasRole('Admin'))

            <span class="badge bg-danger mt-2">
                ADMIN
            </span>

        @elseif(auth()->user()->hasRole('QA Manager'))

            <span class="badge bg-success mt-2">
                QA MANAGER
            </span>

        @elseif(auth()->user()->hasRole('QC Executive'))

            <span class="badge bg-primary mt-2">
                QC EXECUTIVE
            </span>

        @else

            <span class="badge bg-secondary mt-2">
                USER
            </span>

        @endif

    </div>

    <hr class="text-secondary">

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
            <a href="{{ route('samples.index') }}"
               class="{{ request()->routeIs('samples.*') ? 'active' : '' }}">
                <i class="bi bi-beaker"></i>
                <span>Samples</span>
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
            <a href="{{ route('sample-tests.index') }}"
               class="{{ request()->routeIs('sample-tests.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-data"></i>
                <span>Laboratory Tests</span>
            </a>
        </li>

        @can('approve samples')
        <li>
            <a href="{{ route('qa.index') }}"
               class="{{ request()->routeIs('qa.*') ? 'active' : '' }}">
                <i class="bi bi-check-circle-fill"></i>
                <span>QA Approval</span>
            </a>
        </li>
        @endcan

        <li>
            <a href="{{ route('coa.index') }}"
               class="{{ request()->routeIs('coa.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-check"></i>
                <span>COA</span>
            </a>
        </li>

        <li>
            <a href="{{ route('batch.index') }}"
               class="{{ request()->routeIs('batch.*') ? 'active' : '' }}">
                <i class="bi bi-diagram-3"></i>
                <span>Batch Traceability</span>
            </a>
        </li>

        <li>
            <a href="{{ route('reports.index') }}"
               class="{{ request()->routeIs('reports.*') || request()->routeIs('report.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i>
                <span>Reports</span>
            </a>
        </li>

        @can('manage users')

        <li>
            <a href="{{ route('users.index') }}"
               class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Users</span>
            </a>
        </li>

        <li>
            <a href="{{ route('activity.index') }}"
               class="{{ request()->routeIs('activity.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span>Activity Logs</span>
            </a>
        </li>

        <li>
            <a href="{{ route('audit.index') }}"
               class="{{ request()->routeIs('audit.*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i>
                <span>Audit Trail</span>
            </a>
        </li>

        <li>
            <a href="{{ route('settings.index') }}"
               class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                <span>Settings</span>
            </a>
        </li>

        @endcan

    </ul>

</aside>