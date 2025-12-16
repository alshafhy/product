{{-- @@extends('layouts.app')

@@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
@if($config->options->localized)
                        @@lang('crud.edit') @@lang('models/{!! $config->modelNames->camelPlural !!}.singular')
@else
                        Edit {{ $config->modelNames->human }}
@endif
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div>

        @@include('adminlte-templates::common.errors')

        <div class="card">

            @{!! Form::model(${{ $config->modelNames->camel }}, ['route' => ['{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.update', ${{ $config->modelNames->camel }}->{{ $config->primaryName }}], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.fields')
                </div>
            </div>

            <div class="card-footer">
                @{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.index') }}" class="btn btn-default">@if($config->options->localized) @@lang('crud.cancel') @else Cancel @endif</a>
            </div>

            @{!! Form::close() !!}

        </div>
    </div>
@@endsection --}}
@@extends('layouts.app')

@@section('title', __('models/{{ $config->modelNames->camelPlural }}.plural'))

@@section('breadcrumbs', __('models/{{ $config->modelNames->camelPlural }}.plural'))


@@section('content')

    <div>

        @@include('layouts.partials.messages')

        <div class="card">

            @{!! Form::model(${{ $config->modelNames->camel }}, ['route' => ['{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.update', ${{ $config->modelNames->camel }}->{{ $config->primaryName }}], 'method' => 'patch']) !!}
            <div class="card-header">
                {{-- <h4 class="card-title">{{  __('models/$MODEL_NAME_PLURAL_CAMEL$.plural') }} - @lang('crud.edit')  </h4> --}}
                <h4 class="card-title">
                    @if($config->options->localized)
                    @@lang('models/{!! $config->modelNames->camelPlural !!}.singular') - @@lang('crud.edit')
                    @else
                    {{ $config->modelNames->human }} Details
                    @endif 
                </h4>
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => '$ROUTE_NAMED_PREFIX$$MODEL_NAME_PLURAL_CAMEL$','action_name' => 'edit']) --}}
                @@include('layouts.partials.form_toolbar', ['screen_name' => '{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.fields')
                </div>
            </div>

            <div class="card-footer">
                @{!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.index') }}" class="btn btn-default">@if($config->options->localized) @@lang('crud.cancel') @else Cancel @endif</a>
            </div>

            @{!! Form::close() !!}

        </div>
    </div>
@@endsection
