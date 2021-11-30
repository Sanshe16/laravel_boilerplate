@extends('backend.layouts.master-admin')
@section('styles')
    <link rel="stylesheet" href="{{asset('frontend/css/sumoselect.css')}}">
    <style>
        .SumoSelect {
            color: black;
            width: 90%;
        }
    </style>
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
                    <div class="row">
                        <label class="col-3">
                           <h6>Role name</h6>
                        </label>
                        <div class="col-9">
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--space m-separator--dashed"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="">Edit Permissions for {{$role->name}}</h5>
                            <div class="card border-0">
{{--                                <div class="card-header">Role</div>--}}
                                <div class="card-body">
                                    {{ Form::open(array('url' => route('roles.permissions.store', $role->id), 'class' => 'form-horizontal')) }}
                                    <ul>
                                        <div class="row">
                                            @foreach($actions as $action)
                                                <div class="col-md-4">
                                                    <?php $first= array_values($action)[0];
                                                    $firstname =explode(".", $first)[0];
                                                    ?>
                                                    {{Form::label($firstname, $firstname, ['class' => 'form col-md-8 capital_letter'])}}
                                                    <select name="permissions[]" class="select" multiple="multiple">
                                                        @foreach($action as $act)
                                                                {{array_key_exists($act, $rolesPermissions)}}
                                                            <option value="{{$act}}" {{array_key_exists($act, $rolesPermissions)?"selected":""}}>
                                                                <?php
                                                                $rest = explode(".", $act);
                                                                ?>
                                                                @foreach($rest as $item)
                                                                    {{$item}}
                                                                @endforeach
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        </div> <br>



                                        <div class="form-group row">
                                            <div class="col-sm-offset-2 col-sm-2">
                                                <a href="{{route('roles.index')}}" class="btn btn-grey-lighter btn-sm form-control text-white">Back to list</a>
                                            </div>
                                            <div class="col-sm-offset-2 col-sm-2">
                                                {!! Form::submit('Submit', ['class' => 'btn btn-breez btn-sm form-control text-white']) !!}
                                            </div>
                                        </div>
                                    </ul>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>


@stop
@section('scripts')
    <script src="{{asset('frontend/js/jquery.sumoselect.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.select').SumoSelect({ search: true, selectAll: true, placeholder: 'Nothing selected' });
        });
    </script>
@stop

