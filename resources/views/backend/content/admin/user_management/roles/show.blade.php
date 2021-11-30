@extends('backend.layouts.master-admin')
@section('styles')
@stop
@section('content')

    <div class="header-spacer"></div>

    <div class="container">
        <div class="row">
            <div class="col">
            <div class="card">
                <div class="card-header">
                    Role
                </div>

                <div class="card-body">

                    <div class="row mb-2">
                        <label class="col-3">
                           <h6>Role names</h6>
                        </label>
                        <div class="col-9">
                            {{ $role->name }}
                        </div>
                    </div>

                       <div class="row mb-3">
                            <label class="col-3">
                             <h6>Permissions</h6>
                            </label>
                          <div class="col-9">
                                <a class="btn btn-purple btn-sm" href="{{route('roles.permissions', $role->id)}}">Permissions</a>
                          </div>
                      </div>
                    <div class="m-separator m-separator--space m-separator--dashed"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mb-2">List of Users Attached to this Role</h4>
                                        <table id="tblUsers" class="table table-striped- table-bordered table-hover table-checkable">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
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
@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#tblUsers').DataTable({
                processing:true,
                serverSide:true,
                ajax:'{{route('roles.show',$role->id)}}',
                columns:[
                    {data:'name',name:'name'},
                    {data:'email',name:'email'},
                ]
            });
        });
    </script>
@stop
