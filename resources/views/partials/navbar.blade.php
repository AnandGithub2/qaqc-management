<nav class="navbar navbar-expand-lg shadow fixed-top custom-navbar">

    <div class="container-fluid">

        <!-- Mobile Toggle -->

        <button class="btn btn-link text-white d-lg-none p-0 me-3" id="menuBtn">

            <i class="bi bi-list fs-2"></i>

        </button>

        <!-- Logo -->

        <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center">

            @if(isset($appSetting) && $appSetting->company_logo)

                <img src="{{ asset('storage/'.$appSetting->company_logo) }}"
                     class="company-logo me-3">

            @else

                <div class="company-icon me-3">

                    <i class="bi bi-building-fill"></i>

                </div>

            @endif

            <div>

                <h6 class="mb-0 text-white fw-bold">

                    {{ $appSetting->company_name ?? 'QA/QC ERP' }}

                </h6>

                <small class="text-light opacity-75">

                    Quality Management System

                </small>

            </div>

        </a>

        <!-- Right Side -->

        <div class="d-flex align-items-center ms-auto">

            <div class="text-end me-4 d-none d-md-block">

                <div class="text-white fw-semibold">

                    {{ auth()->user()->name }}

                </div>

                <small class="text-light opacity-75">

                    {{ auth()->user()->roles->first()->name ?? 'Administrator' }}

                </small>

            </div>

            <a href="{{ route('profile.edit') }}"
               class="btn btn-light rounded-circle me-2 nav-icon-btn">

                <i class="bi bi-person-fill text-primary"></i>

            </a>

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button class="btn btn-danger rounded-circle nav-icon-btn">

                    <i class="bi bi-box-arrow-right"></i>

                </button>

            </form>

        </div>

    </div>

</nav>