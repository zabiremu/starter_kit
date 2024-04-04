@extends('backend.app') <!-- Extends the backend layout -->


@section('tittle','Create User')
@section('content')
    <!-- Content section -->
    <div class="h-100 col-md-12 d-flex justify-content-center align-items-center grid-margin stretch-card">
        <div class="col-md-10 d-flex justify-content-center grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Form for create role -->
                    <h4 class="card-title">Create Role</h4>
                    <form class="forms-sample" action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <!-- Input field for role name -->
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
                        <!-- Buttons for submit and cancel -->
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-inverse-success btn-fw mr-2 ">Submit</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-inverse-danger ">Cancel</a>
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
