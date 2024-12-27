{{-- Select2 --}}
@if (in_array('select2', $plugins))
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/select2.css">
@endpush
@push('scripts-plugins')
<script src="{{ asset('assets') }}/js/select2/select2.full.min.js"></script>
@endpush
@endif

{{-- DatePicker --}}
@if (in_array('datepicker', $plugins) || true)
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/date-picker.css">
@endpush
@push('scripts-plugins')
<script src="{{ asset('assets') }}/js/datepicker/date-picker/datepicker.js"></script>
@endpush
@endif

{{-- DataTable --}}
@if (in_array('datatable', $plugins))
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/datatables.css">
@endpush
@push('scripts-plugins')
<script src="{{ asset('assets') }}/js/datatable/datatables/jquery.dataTables.min.js"></script>
@endpush
@endif