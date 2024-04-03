@extends('backend.app') <!-- Extends the backend layout -->


@section('tittle','Users lists')
@section('content')
    <!-- Content section -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">User List</h4>
            <div class="table-responsive">
              <table class="table table-dark" id="yajra-datatables">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Image</th>
                    <th> User Name </th>
                    <th> Email</th>
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
                serverSide: true,
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
@endpush

