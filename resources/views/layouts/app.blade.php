<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $appSetting->company_name ?? 'QA/QC ERP' }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

@include('partials.navbar')

<div class="layout">

    @include('partials.sidebar')

    <div id="overlay"></div>

    <main class="main-content">

        <div class="container-fluid py-4">

            @yield('content')

        </div>

        @include('partials.footer')

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@yield('scripts')

</body>
</html>