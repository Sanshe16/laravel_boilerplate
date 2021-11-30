@extends('backend.layouts.master-admin')
@section('styles')

@stop
@section('content')
    <!--  BEGIN CONTENT AREA  -->

      <div class="container">
          <div class="card">
              <div class="card-header">
                  <div class="row">
                      <div class="col-md-12">
                          Users
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="layout-px-spacing">

                          <div class="row layout-top-spacing">

                              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                      <div class="table-responsive mb-4 mt-4">
                                          <table id="user-data" class="table table-hover" style="width:100%">
                                              <thead>
                                              <tr>
                                                  <th>Full Name</th>
                                                  <th>UserName</th>
                                                  <th>Email</th>
                                                  <th>Role</th>
                                                  <th>Registered On</th>
                                              </tr>
                                              </thead>
                                          </table>
                                      </div>
                              </div>

                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>



    <!--  END CONTENT AREA  -->
@endsection
@section('scripts')

    <script>
        $('#user-data').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            processing: true,
            serverSide: true,
            ajax: '{{route('sa.users.data.index')}}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'created_at', name: 'created_at'},
                ],
        });
    </script>
@endsection
