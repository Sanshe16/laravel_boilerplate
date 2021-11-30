@extends('backend.layouts.master-admin')
@section('styles')

    <style>
        .dataTables_filter { display: none; }
    </style>
@stop
@section('content')

    <div class="header-spacer"></div>

    <div class="container">
        <div class="row">
                <!-- Main Content -->
                <main class="col col-xl-12 order-xl-12 col-lg-12 order-lg-12 col-md-12 col-sm-12 col-12">
                         <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 my-auto">
                            Roles & Permissions
                        </div>
                        <div class="col-md-2">
                            <div class="text-right">
                                <a href="{{route('roles.create')}}" class="btn btn-primary btn-sm text-white">Add New Role<div class="ripple-container"></div></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="m-portlet">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissable" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="m-portlet__body">
                                    <h4 class="mb-3">List of all the roles</h4>
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <table id="tblRoles" class="table table-striped- table-bordered table-hover table-checkable">
                                                <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Name</th>
                                                    <th>Actions</th>
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
                </main>
        </div>
    </div>

    <!-- ... end Responsive Header-BP -->
    <div class="header-spacer"></div>
    {{--End Test--}}
@stop
@section('scripts')

    <script type="text/javascript">

        $(document).ready(function () {

            // Hide alerts and errors of datatable
            $.fn.dataTable.ext.errMode = 'none';
            var app_route = '{{route('roles.index')}}';

            // var params = {
            //     'status': $('#active_status option:selected').text(),
            // };

            var table = $('#tblRoles').DataTable({

                // begin first table

                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: app_route,
                    type: 'GET',
                    /*data: function ( d ) {
                        d.status = $('#active_status').val();

                    },*/
                    error: function(data){
                        console.log(data);
                    }
                },
                language: {
                    searchPlaceholder: "Search...",
                    search: "",
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    // {data: 'slug'},

                    {
                        data: null,
                        responsivePriority: 100,
                        orderable: false,
                        searchable: false,
                        render: function ( data, type, row ) {

                            var view_url = '{{route('roles.show', ':id')}}';
                            view_url = view_url.replace(':id', row.id);
                            var edit_url = '{{route('roles.edit', ':id')}}';
                            edit_url = edit_url.replace(':id', row.id);

                            return '<a href="'+view_url+'" class="bs-tooltip" data-placement="top" title="View">'
                                +'<i class="fas fa-eye" style="width: 2.125em;"></i>'
                                +'</a>'

{{--                                @if(in_array('roles.update', array_keys(session('user')['routePermissions'])))--}}
                                + ' <a href="'+edit_url+'" class="bs-tooltip" data-placement="left" title="Edit">'
                             +'<i class="fas fa-edit" style="width: 2.125em;"></i>'
                                +'</a>'
{{--                                @endif--}}

{{--                                @if(in_array('api.v1.roles.destroy', array_keys(session('user')['routePermissions'])))--}}
                                + ' <a href="javascript:void(0);" data-id="'+data.id+'" id="deleteData"></a>'
                                +'<i class="fas fa-delete" style="width: 2.125em;"></i>'
{{--                                @endif--}}
                                ;

                        },
                    }
                ],

                order: [[0, "asc"]],

            });

        });
    </script>
@endsection
