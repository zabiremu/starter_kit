@extends('backend.app') <!-- Extends the backend layout -->

<!-- Dropify styles -->
@push('css')

    <style>
        .dropify-wrapper {
            background-color: #2A3038 !important;
            color: #fff !important;
            border-color: #2A3038;
        }
    </style>
@endpush
@section('tittle')
User Information
@endsection
@section('content')
    <!-- Content section -->
    <div class="h-100 col-md-12 d-flex justify-content-center grid-margin stretch-card">
        <div class="col-md-7 d-flex justify-content-center grid-margin stretch-card">
            <div class="card" style="height: 68%">
                <div class="card-body">
                    <!-- Form for user information -->
                    <h4 class="card-title">User Information</h4>
                    <form class="forms-sample" action="{{ route('admin.profile.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="id"
                            value="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}" hidden>
                        <!-- Input field for user name -->
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Please enter your name" name="name"
                                    value="{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for user phone -->
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" placeholder="Please enter your phone number" name="phone"
                                    value="{{ isset( Auth::user()->phone) ? Auth::user()->phone : '' }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for user email -->
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="Please enter your email" name="email"
                                    value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- File input for user logo -->
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="dropify" name="image" id="image"
                                    data-allowed-file-extensions="png jpg jpeg"
                                    data-default-file="{{ isset(Auth::user()->image) ? asset(Auth::user()->image) : '' }}" />
                            </div>
                        </div>
                        <!-- Buttons for update and cancel -->
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-inverse-success btn-fw mr-2 ">Update</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-inverse-danger ">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize dropify on document ready
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush
