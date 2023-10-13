<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageName??config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    @include('admin::components.loader')

    <!-- Navbar -->
    @include('admin::components.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin::components.main-sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin::components.header')
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin::components.footer')

    <!-- Control Sidebar -->
    @include('admin::components.sidebar')
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    function checkRecordTable(selector) {
        let table = $(selector);
        if (table.find('tbody tr').length == 0) {
            let countTh = table.find('thead th').length;
            table.find('tbody').html('<tr><td colspan="' + countTh + '" class="text-center">{{ __('Không có dữ liệu hiển thị') }}</td></tr>')
        }
    }
</script>
@stack('js')
</body>
</html>
