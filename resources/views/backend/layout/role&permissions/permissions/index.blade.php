@extends('backend.app')

@section('title','Permissions')

@push('css')
    <style>
        ul{
            list-style: none;
        }
    </style>
@endpush
@section('content')
    @php
        $role_name;
    @endphp
    <form action="{{route('store.permissions')}}" method="post">
        @csrf
        <div class="h-100 col-md-12 d-flex justify-content-center align-items-center grid-margin stretch-card">
            <div class="col-md-10 d-flex justify-content-center grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                            <!-- Input field for roles -->
                            <div class="form-group row">
                                <div class="col-5">
                                    <h4 class="card-title">Roles</label>
                                </div>
                                <div class="col-lg-7">
                                    <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                        <option value="" selected disabled>Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <h4 class="card-title">Permissions</h4>
                        <div class="form-group">
                            <ul class="d-flex justify-content-around flex-wrap">
                                <li>
                                    <div class="form-group d-flex align-items-center gap-2">
                                        <input type="checkbox" class="" name="permissions[]" value="All">
                                        <label for="" class="text-capitalize mb-0 ">All</label>
                                    </div>
                                </li>
                                @foreach ($permissions as $key=> $permissions)
                                            <li class="">
                                                {{ $permissions->group_name }}
                                                <ul class="pt-3" style="padding-left: 0;">
                                                    <li>
                                                        @php
                                                            $permission_names = $permissions->names;
                                                            $names = explode(',', $permission_names);
                                                            $permission_id = $permissions->id;
                                                            $ids = explode(',', $permission_id);
                                                        @endphp
                                                        @foreach ($ids as $id)
                                                            @foreach ($names as $name)
                                                                <div class="form-group d-flex align-items-center gap-2">
                                                                    <input type="checkbox" class="" name="permissions[]"
                                                                        value="{{ $name ?? '' }}">
                                                                    <label for=""
                                                                        class="text-capitalize mb-0 ">{{ $name }}</label>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-inverse-success btn-fw mr-2 ">Submit</button>
                            <a href="{{route('dashboard')}}" class="btn btn-inverse-danger ">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#role_id').change(function() {
                var roleId = $(this).val();

                if (roleId) {
                    $.ajax({
                        url: "get-permissions",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            role_id: roleId
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data,'data')
                            if (data.success) {
                                var rolePermissions = data.permissions;
                                updatePermissions(rolePermissions);
                            } else {
                                console.log(data.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error,'error')
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            function updatePermissions(rolePermissions) {
                // Uncheck all checkboxes initially
                $('[name="permissions[]"]').prop('checked', false);
                console.log(rolePermissions)
                // Iterate over the permission names and check corresponding checkboxes
                $.each(rolePermissions, function(index, permissionName) {
                    $('[name="permissions[]"][value="' + permissionName + '"]').prop('checked', true);
                });
            }
        });
    </script>
@endsection

