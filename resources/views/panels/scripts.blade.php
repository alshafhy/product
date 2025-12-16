<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
<!-- select2 Main scripts -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

<!-- for datepicker Main scripts -->
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
{{-- Form Numbers --}}
<script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js'))}}"></script>
{{-- Custom  File Input --}}
<script src="{{ asset(mix('vendors/js/jasny/jasny-bootstrap.min.js'))}}"></script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif

<!-- select2 init script -->
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

<!-- datepickers init script -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
<script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
{{-- Form Numbers --}}
<script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>

<script>
    var BASE_URL = "{{ config('app.url') }}";
    var csrf_token = "{{ csrf_token() }}";
</script>

<script src="{{ asset(mix('js/scripts/crud.js')) }}"></script>


<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
@stack('page-script')
<!-- END: Page JS-->
