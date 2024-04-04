@php
    $company= App\Models\CompanyInformation::first();
    $generalSettings= App\Models\GeneralInformation::first();
@endphp
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="directive">
    <meta name='description' content='{{$generalSettings->meta_description}}'>
    <meta name='keywords' content='{{$generalSettings->meta_keywords}}'>
    <meta name="author" content="{{$generalSettings->author_name}}">
    <title>
        @yield('tittle')
    </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset($company->favicon) }}" />
    <!-- dropify styles -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dropify.min.css') }}">
     <!-- CKEditor styles -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/CKEditor/custom_ck.css') }}">
    <style>
        div#yajra-datatables_filter {
            float: inline-end;
        }
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 20px;
            padding-right: 10px;
            float: inline-end;
        }
        .dataTables_wrapper .dataTables_info {
            font-size: 0.875rem;
            padding-top: 12px;
        }
        .swal2-modal .swal2-title {
            font-size: 25px;
            line-height: 1;
            font-weight: 500;
            color: inherit;
            font-weight: initial;
            margin-bottom: 0;
        }
        .swal2-modal .swal2-icon, .swal2-modal .swal2-success-ring {
            margin-top: 42px;
            margin-bottom: 10px;
        }
        div:where(.swal2-container).swal2-center>.swal2-popup {
            grid-column: 2;
            grid-row: 2;
            place-self: center center;
            padding-bottom: 30px;
        }
        .badge-outline-success:hover{
            color: #fff;
            background-color: #00d25b;
        }
        .badge-outline-danger:hover{
            color: #fff;
            background-color: #fc424a;
        }
    </style>
    @stack('css')
</head>
