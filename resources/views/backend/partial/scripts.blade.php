<!-- JS Scripts -->
<script src="{{ URL::asset('frontend/js/jQuery/jquery-3.5.1.js') }}"></script>
{{--@toastr_js--}}
<script src="{{ URL::asset('frontend/cdnToLocal/toastr/js/toastr.js') }}"></script>
@toastr_render

<script src="{{ URL::asset('frontend/js/libs/jquery.appear.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/jquery.mousewheel.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/perfect-scrollbar.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/svgxuse.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/imagesloaded.pkgd.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/Headroom.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/popper.min.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/material.min.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/bootstrap-select.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/smooth-scroll.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/selectize.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/swiper.jquery.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/moment.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/isotope.pkgd.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/ajax-pagination.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/jquery.magnific-popup.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs/aos.js') }}"></script>

<script src="{{ URL::asset('frontend/js/main.js') }}"></script>
<script src="{{ URL::asset('frontend/js/libs-init/libs-init.js') }}"></script>
<script defer src="{{ URL::asset('frontend/fonts/fontawesome-all.js') }}"></script>

<script src="{{ URL::asset('frontend/Bootstrap/dist/js/bootstrap.bundle.js') }}"></script>

<!-- SVG icons loader -->
<script src="{{ URL::asset('frontend/js/svg-loader.js') }}"></script>
<script src="{{asset('frontend/table/datatable/datatables.js')}}"></script>
<!-- /SVG icons loader -->
@yield('scripts')
