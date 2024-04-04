@extends('backend.app') <!-- Extends the backend layout -->


@section('tittle','Roles lists')
@section('content')
    <!-- Content section -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title ">Role List</h4>
                <!-- Button trigger modal -->
                <button type="button" data-toggle="modal" data-target="#modal" class="btn btn-outline-primary btn-fw">Add</button>


                <!-- Modal -->
                <div class="modal fade mt-5" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <form action="{{route('roles.store')}}" method="post" >
                        @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Role</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" class="form-control @error('name')
                                        is-invalid
                                    @enderror" name="name" placeholder="Role" >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="bbtn btn-inverse-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-inverse-success">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- modal end --}}
            </div>
            <div class="table-responsive">
              <table class="table table-dark w-100" id="yajra-datatables">
                <thead>
                  <tr class="w-100">
                    <th> # </th>
                    <th> Role</th>
                    <th> Action</th>
                  </tr>
                </thead>
                <tbody class="w-100">

                </tbody>
              </table>
            </div>
          </div>
        </div>
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
                ajax: "{{ route('roles.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'Name',
                        orderable: true,
                        searchable: true
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
    </script>
@endpush

