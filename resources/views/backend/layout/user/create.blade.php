@extends('backend.app') <!-- Extends the backend layout -->


@section('tittle','Create User')
@section('content')
    <!-- Content section -->
    <div class="h-100 col-md-12 d-flex justify-content-center align-items-center grid-margin stretch-card">
        <div class="col-md-10 d-flex justify-content-center grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Form for create user -->
                    <h4 class="card-title">Create User</h4>
                    <form class="forms-sample" action="{{ route('users.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Input field for user name -->
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Please enter your name" name="name"/>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for user phone number -->
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" placeholder="Please enter your cphone" name="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for roles -->
                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">Roles</label>
                            <div class="col-sm-9">
                                <select name="role" id="role" class="form-control @error('role')
                                 is-invalid
                                @enderror">
                                    <option value="" selected disabled>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <!-- Input field for email -->
                         <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="Please enter your email" name="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Input field for password -->
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Please enter your password" name="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- File input for user image -->
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="dropify" name="image" id="image"
                                    data-allowed-file-extensions="png jpg jpeg webp"/>
                            </div>
                        </div>
                        <!-- Buttons for update and cancel -->
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-inverse-success btn-fw mr-2 ">Submit</button>
                            <a href="{{ route('users.index') }}" class="btn btn-inverse-danger ">Cancel</a>
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
