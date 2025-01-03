<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Majestic Bus System</title>

    <!-- plugins:css -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/style.css') }}">
    <!-- endinject -->

    <link rel="shortcut icon" href="{{ asset('/frontend/assets/images/favicon.ico') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('frontend.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('frontend.partials.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- partial:partials/_footer.html -->
                @include('frontend.partials.footer')
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('/frontend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('/frontend/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('/frontend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('/frontend/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/template.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/settings.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/todolist.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('/frontend/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/proBanner.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/jquery.cookie.js') }}"></script>
    @stack('scripts')
</body>
<style>
    .content-wrapper {
        background: url('{{ asset('/bus.png') }}')  no-repeat center center fixed;
        background-size: cover;
    }
</style>
</html>
