@extends('layouts/verticalLayoutMaster')

@section('title', 'POS - CashPOS')

@section('content')
<div class="row">
    <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 rounded">
            <div class="container-fluid">
                <span class="navbar-brand fw-bold text-primary">
                    <i data-feather="monitor" class="me-1"></i> CashPOS
                </span>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @can('sale_invoice.create')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pos/sales/create') ? 'active' : '' }}" href="/pos/sales/create">
                                <i data-feather="plus-circle" class="me-1"></i> عملية بيع
                            </a>
                        </li>
                        @endcan
                        
                        @can('sale_invoice.view')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pos/sales') ? 'active text-primary fw-bold' : '' }}" href="/pos/sales">
                                <i data-feather="list" class="me-1"></i> الفواتير
                            </a>
                        </li>
                        @endcan

                        @can('product.view')
                        <li class="nav-item">
                            <a class="nav-link" href="/pos/products">
                                <i data-feather="box" class="me-1"></i> المنتجات
                            </a>
                        </li>
                        @endcan

                        @can('customer.view')
                        <li class="nav-item">
                            <a class="nav-link" href="/pos/customers">
                                <i data-feather="users" class="me-1"></i> العملاء
                            </a>
                        </li>
                        @endcan

                        @can('treasury.view')
                        <li class="nav-item">
                            <a class="nav-link" href="/pos/treasury">
                                <i data-feather="dollar-sign" class="me-1"></i> الخزينة
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </nav>
        
        @yield('pos-content')
    </div>
</div>
@endsection

@push('vendor-style')
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
@endpush

@push('vendor-script')
<script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endpush

@push('page-script')
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    });
</script>
@endpush
