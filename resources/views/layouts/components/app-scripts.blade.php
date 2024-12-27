@foreach ($permissions as $key => $value)
<input type="hidden" name="{{$key}}" class="permission_status" data-name="{{$key}}" value="{{$value ? 1 : 0}}">
@endforeach

<!-- latest jquery-->
<script src="{{ asset('assets') }}/js/jquery-3.5.1.min.js"></script>
<!-- feather icon js-->
<script src="{{ asset('assets') }}/js/icons/feather-icon/feather.min.js"></script>
<script src="{{ asset('assets') }}/js/icons/feather-icon/feather-icon.js"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets') }}/js/sidebar-menu.js"></script>
<script src="{{ asset('assets') }}/js/config.js"></script>
<!-- Bootstrap js-->
<script src="{{ asset('assets') }}/js/bootstrap/popper.min.js"></script>
<script src="{{ asset('assets') }}/js/bootstrap/bootstrap.min.js"></script>
<!-- Theme js-->
<script src="{{ asset('assets') }}/js/script.js"></script>
<script src="{{ asset('assets') }}/js/theme-customizer/customizer.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{ asset('assets') }}/js/datepicker/date-picker/datepicker.js"></script>
<script src="{{ asset('assets') }}/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="{{ asset('assets') }}/js/datepicker/date-picker/datepicker.custom.js"></script>

<script src="{{ asset('js/plugin/loading-overlay/loadingoverlay.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('js/main.js?v=123') }}"></script>
<script src="{{ asset('js/menu.js?v=123') }}"></script>