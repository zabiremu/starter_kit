@extends('backend.app') <!-- Extends the backend layout -->


@section('tittle','User\\s lists')
@section('content')
    <!-- Content section -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">User List</h4>
            <div class="table-responsive" id="yajra-datatables">
              <table class="table table-dark">
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

