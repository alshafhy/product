{{-- @@extends('layouts.app')

@@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
@if($config->options->localized)
                    @@lang('crud.create') @@lang('models/{!! $config->modelNames->camelPlural !!}.singular')
@else
                    Create {{ $config->modelNames->humanPlural }}
@endif
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div>

        @@include('adminlte-templates::common.errors')

        <div class="card">

            @{!! Form::open(['route' => '{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.store']) !!}

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
@@endsection

 --}}
@@extends('layouts.app')
@@section('title', __('models/{{ $config->modelNames->camelPlural }}.plural'))

@@section('breadcrumbs', __('models/{{ $config->modelNames->camelPlural }}.plural'))

@@section('content')
    
    <div>

        @@include('layouts.partials.messages')

        <div class="card">

            @{!! Form::open(['route' => '{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.store']) !!}
            <div class="card-header">
                {{-- <h4 class="card-title">{{  __('models/$MODEL_NAME_PLURAL_CAMEL$.plural') }} - @lang('crud.add_new')  </h4> --}}
                <h4 class="card-title">
                @if($config->options->localized)
                @@lang('models/{!! $config->modelNames->camelPlural !!}.singular') - @@lang('crud.add_new')
                @else
                {{ $config->modelNames->human }} Details
                @endif 
                </h4>
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => '$ROUTE_NAMED_PREFIX$$MODEL_NAME_PLURAL_CAMEL$','action_name' => 'create']) --}}
                @@include('layouts.partials.form_toolbar', ['screen_name' => '{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}','action_name' => 'create'])
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
