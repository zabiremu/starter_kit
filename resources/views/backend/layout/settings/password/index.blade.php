@extends('backend.app') <!-- Extends the backend layout -->

@section('tittle','User Password')
@section('content')
    <!-- Content section -->
    <div class="h-100 col-md-12 d-flex justify-content-center align-items-center grid-margin stretch-card">
        <div class="col-md-7 d-flex justify-content-center grid-margin stretch-card">
            <div class="card" style="height: 68%">
                <div class="card-body">
                    <!-- Form for user information -->
                    <h4 class="card-title">User Password</h4>
                    <form class="forms-sample" action="{{ route('admin.password.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="id"
                            value="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}" hidden>
                        <!-- Input field for user current password -->
                        <div class="form-group row">
                            <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" placeholder="Please enter current password" name="current_password">
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <!-- Input field for user new password -->
                        <div class="form-group row">
                            <label for="new_password" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" placeholder="Please enter new password" name="new_password">
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for user confirm password -->
                        <div class="form-group row">
                            <label for="confirm_password" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                    id="confirm_password" placeholder="Please enter confirm password" name="confirm_password">
                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

