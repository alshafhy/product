{{-- @@extends('layouts.app')

@@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
@if($config->options->localized)
@@lang('models/{!! $config->modelNames->camelPlural !!}.singular') @@lang('crud.detail')
@else
{{ $config->modelNames->human }} Details
@endif
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural  !!}.index') }}">
                        @if($config->options->localized)
                            @@lang('crud.back')
                        @else
                            Back
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.show_fields')
                </div>
            </div>
        </div>
    </div>
@@endsection --}}
@@extends('layouts.app')

@@section('title', __('models/{{ $config->modelNames->camelPlural }}.plural'))

@@section('breadcrumbs', __('models/{{ $config->modelNames->camelPlural }}.plural'))

@@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{-- {{  __('models/$MODEL_NAME_PLURAL_CAMEL$.plural') }} - @lang('crud.show')  --}}
                @if($config->options->localized)
                @@lang('models/{!! $config->modelNames->camelPlural !!}.singular') - @@lang('crud.show')
                @else
                {{ $config->modelNames->human }} Details
                @endif 
                </h4>
                @@include('layouts.partials.form_toolbar', ['screen_name' => '{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}','action_name' => 'show'])
            </div>
            <div class="card-body border-top">
                <div class="row"  style="padding-top: 20px;">
                    @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.show_fields')
                </div>
            </div>
        </div>
    </div>
@@endsection
