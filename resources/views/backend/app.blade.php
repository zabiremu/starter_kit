<!DOCTYPE html>
<html lang="en">
{{-- head section start  --}}
@include('backend.partials.head')
{{-- head section end  --}}

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        {{-- sidebar section start  --}}
        @include('backend.partials.sidebar')
        {{-- sidebar section end  --}}


        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->

            {{-- header section start  --}}
            @include('backend.partials.navbar')
            <!-- header navbar end  -->

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper h-100">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->


                <!-- Footer start  -->
                @include('backend.partials.footer')
                <!-- Footer End  -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    {{-- script start  --}}
    @include('backend.partials.script')
    {{-- script end --}}
</body>

</html>
