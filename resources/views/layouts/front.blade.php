<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>{{ ($title ?? ' Title') . ' - ' . env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ env('APP_NAME') }}" name="description">
    <meta content="{{ env('APP_AUTHOR') }}" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('img/fav.png') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('hybrix') }}/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('hybrix') }}/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('hybrix') }}/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('hybrix') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('hybrix') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('hybrix') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('hybrix') }}/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('hybrix') }}/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    @if (isset($datatable))
        <!-- DataTables -->
        <link href="{{ asset('hybrix') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
            rel="stylesheet" type="text/css">
        <link href="{{ asset('hybrix') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
            rel="stylesheet" type="text/css">

        <!-- Responsive datatable examples -->
        {{-- <link href="{{ asset('hybrix') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"> --}}
    @endif


    <style>
        .centerMarker {
            position: absolute;
            /*url of the marker*/
            background: url(http://maps.gstatic.com/mapfiles/markers2/marker.png) no-repeat;
            /*center the marker*/
            top: 50%;
            left: 50%;
            z-index: 1;
            /*fix offset when needed*/
            margin-left: -10px;
            margin-top: -34px;
            /*size of the image*/
            height: 34px;
            width: 20px;
            cursor: pointer;
            color: black;
        }

        .keterangan>* {
            color: black !important;
        }
    </style>

    @stack('css')

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <form class="d-flex" role="search">
                    <a href="{{ route('login') }}" class="btn btn-outline-success" type="submit">Login</a>
                </form>
            </div>
        </div>
    </nav>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @yield('content')
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('hybrix') }}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('hybrix') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('hybrix') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('hybrix') }}/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ asset('hybrix') }}/assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="{{ asset('hybrix') }}/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="{{ asset('hybrix') }}/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="{{ asset('hybrix') }}/assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('hybrix') }}/assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('hybrix') }}/assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="{{ asset('hybrix') }}/assets/js/app.js"></script>

    @if (isset($datatable))
        <!-- Required datatable js -->
        <script src="{{ asset('hybrix') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('hybrix') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        {{-- <script src="{{ asset('hybrix') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('hybrix') }}/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('hybrix') }}/assets/libs/jszip/jszip.min.js"></script>
        <script src="{{ asset('hybrix') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="{{ asset('hybrix') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="{{ asset('hybrix') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{ asset('hybrix') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{ asset('hybrix') }}/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script> --}}

        {{-- Sweetalert 2 --}}
        <script src="{{ asset('hybrix') }}/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    @endif

    <script>
        var longitude = {{ env('LONG_DEFAULT') }};
        var latitude = {{ env('LAT_DEFAULT') }};
    </script>

    @stack('js')
</body>

</html>
