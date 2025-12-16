{{-- @@extends('layouts.app')

@@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
@if($config->options->localized)
                    <h1>@@lang('models/{{ $config->modelNames->camelPlural }}.plural')</h1>
@else
                    <h1>{{ $config->modelNames->humanPlural }}</h1>
@endif
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.create') }}">
@if($config->options->localized)
                         @@lang('crud.add_new')
@else
                        Add New
@endif
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        @@include('flash::message')
        <div class="clearfix"></div>
        <div class="card">
            {!! $table !!}
        </div>
    </div>
@@endsection --}}
@@extends('layouts.app')
@@section('title', __('models/{{ $config->modelNames->camelPlural }}.plural'))

@@section('breadcrumbs', __('models/{{ $config->modelNames->camelPlural }}.plural'))
@@section('content')
    @@include('flash::message')
    <div class="clearfix"></div>
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if($config->options->localized)
                    <h4 class="card-title"> @@lang('models/{{ $config->modelNames->camelPlural }}.plural')</h4>
                    @else
                    <h4>{{ $config->modelNames->humanPlural }}</h4>
                    @endif
                    @@include('layouts.partials.form_toolbar', ['screen_name' => '{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}','action_name' => 'index'])
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $table !!}
                        {{-- $PAGINATE$ --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bordered table end -->
@@endsection
