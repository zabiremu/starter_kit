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
    @stack('css')
</head>
