@extends('backend.layouts.master-admin')
@section('styles')

@stop
@section('content')

    <div class="header-spacer"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                <div class="card">
                    <div class="card-header">Roles</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route('roles.update',['role'=>$role->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col form-group">
                                            <label class="form-control-label">Role Name</label>
                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $role->name ?? '' }}" placeholder="Name"/>
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                        <div class="col-lg-2 float-right">
                                            <input type="submit" class="btn btn-breez btn-sm" value="Update Role"/>
                                        </div>

                                </form>
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

        $(document).ready(function(){

        });

    </script>
@stop
