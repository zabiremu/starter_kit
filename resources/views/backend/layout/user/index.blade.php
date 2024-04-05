@extends('backend.app') <!-- Extends the backend layout -->


@section('tittle','Users lists')
@section('content')
    <!-- Content section -->
    <div class="d-flex justify-content-center align-items-center h-100">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card ">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title ">User List</h4>
                <a href="{{route('users.create')}}" class="btn btn-outline-primary btn-fw">Add</a>
            </div>
            <div class="table-responsive">
              <table class="table table-dark" id="yajra-datatables">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Image</th>
                    <th> User Name </th>
                    <th> Email</th>
                    <th> Role</th>
                    <th> Phone</th>
                    <th> Status</th>
                    <th> Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- Modal -->
     <div class="modal fade mt-5" id="edit-roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="{{route('users.editAssignRole')}}" method="post" >
            @csrf
            @method('PUT')
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" id="id" value="" hidden>
                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">Roles</label>
                            <div class="col-sm-9">
                                <select name="role" id="role_name" class="form-control @error('name')
                                 is-invalid
                                @enderror">
                                    <option value="" selected disabled>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bbtn btn-inverse-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-inverse-success" id="saveRoleBtn">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}"
        type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/dataTables.buttons.min.js') }}"
        type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#yajra-datatables').DataTable({
                processing: true,
                responsive: true,
                serverSide: false,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        name: 'Image',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'name',
                        name: 'Name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'role',
                        name: 'Role',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'phone',
                        name: 'Phone Number',
                        orderable: true,
                        searchable: true
                    },


                    {
                        data: 'status',
                        name: 'Status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: true
                    },
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the delete URL
                        window.location.href = url;
                    }
                });
            });
        });
        $(document).ready(function() {
            $(document).on('click', '.status-btn', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to save this data!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, save it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the delete URL
                        window.location.href = url;
                    }
                });
            });
        });

        function edit(id,name)
        {
            var id= $('#id').val(id);
            var role_name= $('#role_name').val(name);
        }
    </script>
@endpush

