@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush

@include('work_orders.search')

{!! $dataTable->table(['width' => '100%', 'class' => 'table data-table table-striped table-bordered table-responsive'], true) !!}

@push('third_party_scripts')
    @section("page-script")
        @include('layouts.datatables_js')
        {!! $dataTable->scripts() !!}
    @endsection

@endpush


