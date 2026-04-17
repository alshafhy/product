<!-- BEGIN: Vendor CSS-->
@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  <link rel="stylesheet" href="{{ asset('vendors/css/vendors-rtl.min.css') }}" />
@else
  <link rel="stylesheet" href="{{ asset('vendors/css/vendors.min.css') }}" />
@endif
{{-- Select2 Styles --}}
<link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
{{-- Datepickr Styles --}}
<link rel="stylesheet" href="{{ asset('vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
{{-- Form Numbers --}}
<link rel="stylesheet" href="{{ asset('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">

{{-- Custom  File Input --}}
<link rel="stylesheet" href="{{ asset('vendors/css/jasny/jasny-bootstrap.min.css')}}">

@yield('vendor-style')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
@vite(['resources/scss/core.scss'])
<link rel="stylesheet" href="{{ asset('css/base/themes/dark-layout.css') }}" />
<link rel="stylesheet" href="{{ asset('css/base/themes/bordered-layout.css') }}" />
<link rel="stylesheet" href="{{ asset('css/base/themes/semi-dark-layout.css') }}" />

@php $configData = Helper::applClasses(); @endphp

<!-- BEGIN: Page CSS-->
@if ($configData['mainLayoutType'] === 'horizontal')
  <link rel="stylesheet" href="{{ asset('css/base/core/menu/menu-types/horizontal-menu.css') }}" />
@else
  <link rel="stylesheet" href="{{ asset('css/base/core/menu/menu-types/vertical-menu.css') }}" />
@endif

{{-- DatePicker Custom Styles --}}
<link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-pickadate.css') }}">

{{-- Page Styles --}}
@yield('page-style')


<!-- laravel style -->
@vite(['resources/scss/overrides.scss'])

<!-- BEGIN: Custom CSS-->

@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  @vite(['resources/assets/scss/style-rtl.scss'])
@else
  {{-- user custom styles --}}
  @vite(['resources/assets/scss/style.scss'])
@endif
