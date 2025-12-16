@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush
<div class="table-responsive">
{!! $dataTable->table(['width' => '100%', 'class' => 'table  table-bordered']) !!}
</div>
@push('third_party_scripts')
    @section("page-script")
        @include('layouts.datatables_js')
        {!! $dataTable->scripts() !!}
    @endsection

@endpush