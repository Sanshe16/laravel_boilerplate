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
                                Pages Verification Requests
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
                                        <h4 class="mb-3"><span class="font-weight-bold">Name:</span> {{$page->page_title}}</h4>
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <span class="font-weight-bold">Message:</span>
                                                <p>{{$page->verificationRequest->message ?? "No message"}}</p>
                                            </div>
                                            <div class="col-md-12" >
                                                <h3>Verification Documents</h3>
                                                <div class="d-flex">
                                                    <div class="d-flex flex-column justify-content-end align-items-center">
                                                        <img class="" width="250px" src="{{asset($page->verificationRequest->photo)}}" alt="">
                                                        <p>Photo</p>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-end align-items-center">
                                                        <img class="" width="250px" src="{{asset($page->verificationRequest->passport)}}" alt="">
                                                        <p>Passport</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-center mt-3">
                                                <button type="submit" class="px-5 py-3 bg-primary text-white border-0 rounded-lg mr-5" id="verify">Verify</button>
                                                <button type="submit" class="px-5 py-3 bg-danger text-white border-0 rounded-lg" id="reject">Reject</button>
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
        $('#verify').on('click', function () {
            var url = "{{route('admin.pages.verification.verify', encrypt($page->id))}}";
            $.ajax({
                type: "POST",
                data: {
                    _token      :   $('meta[name="csrf-token"]').attr('content')
                },
                url: url,

                success:
                    function (data) {
                        if(data['status'] == '200') {
                            toastr.success(data['message']);
                            window.location.href = "{{route('admin.pages.verification.index')}}";
                        }
                    },
            })
        });
        $('#reject').on('click', function () {
            var url = "{{route('admin.pages.verification.reject', encrypt($page->id))}}";
            $.ajax({
                type: "POST",
                data: {
                    _token      :   $('meta[name="csrf-token"]').attr('content')
                },
                url: url,

                success:
                    function (data) {
                        if(data['status'] == '200') {
                            toastr.success(data['message']);
                            window.location.href = "{{route('admin.pages.verification.index')}}";
                        }
                    },
            })
        });
    </script>
@endsection
