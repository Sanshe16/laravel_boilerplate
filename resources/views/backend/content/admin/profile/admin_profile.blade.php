@extends('backend.layouts.master-admin')


@section('content')
    <!-- Your Account Personal Information -->
    <div class="header-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title">Personal Information</h6>
                    </div>
                    <div class="ui-block-content">


                        <!-- Personal Information Form  -->

                        <form action="{{ route('admin.saveProfile') }}" method="POST">
                            @csrf
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))

                                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                            </div> <!-- end .flash-message -->
                            <div class="row">
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">First Name</label>
                                        <input class="form-control @error('first_name') is-invalid @enderror" placeholder="" type="text" name="first_name" value="{{$user->first_name}}">
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group label-floating">
                                        <label class="control-label">Your Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" placeholder="" name="email" type="email" value="{{$user->email}}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Last Name</label>
                                        <input class="form-control @error('last_name') is-invalid @enderror" placeholder="" type="text" name="last_name" value="{{$user->last_name}}">
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group label-floating">
                                        <label class="control-label">Your Phone Number</label>
                                        <input class="form-control @error('phone_number') is-invalid @enderror" placeholder="" type="text" name="phone_number" value="{{$user->phone_number}}">
                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">

                                    <div class=" form-group label-floating is-select">
                                        <label class="control-label">Your Gender</label>
                                        <select class="selectpicker form-control @error('gender') is-invalid @enderror" name="gender">
                                            <option value="male" {{$user->gender == 'male' ? 'selected="selected"':''}}>Male</option>
                                            <option value="female" {{$user->gender == 'female' ? 'selected="selected"':''}}>Female</option>
                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group label-floating">
                                        <label class="control-label">Religious Beliefs</label>
                                        <input class="form-control @error('religious_beliefs') is-invalid @enderror" placeholder="" type="text" name="religious_beliefs" value="{{$user->religious_beliefs}}">
                                        @error('religious_beliefs')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">{{ __('Password') }}</label>
                                        <input class="form-control @error('password') is-invalid @enderror" placeholder="" type="password" name="password" required autocomplete="new-password" id="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    @error('datetimepicker')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="form-group date-time-picker label-floating @error('datetimepicker') is-invalid @enderror">
                                        <label class="control-label">Your Birthday</label>
                                        <input name="datetimepicker" value="{{$user->dob}}" />
                                        <span class="input-group-addon">
															<svg class="olymp-month-calendar-icon icon"><use xlink:href="#olymp-month-calendar-icon"></use></svg>
														</span>

                                    </div>
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Status</label>
                                        <select class="selectpicker form-control @error('marital_status') is-invalid @enderror" name="marital_status">
                                            <option value="married" {{$user->marital_status == 'married' ? 'selected="selected"':''}}>Married</option>
                                            <option value="single" {{$user->marital_status == 'single' ? 'selected="selected"':''}}>Single</option>
                                        </select>
                                        @error('marital_status')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <button type="submit" class="btn btn-primary btn-lg full-width">Save all Changes</button>
                                </div>
                            </div>
                        </form>

                        <!-- ... end Personal Information Form  -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ... end Your Account Personal Information -->
@endsection
