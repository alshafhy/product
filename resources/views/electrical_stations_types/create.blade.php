@extends('layouts.app')

@section('title', __('models/electricalStationsTypes.plural'))

@section('breadcrumbs', __('models/electricalStationsTypes.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'electricalStationsTypes.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/electricalStationsTypes.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'electricalStationsTypes','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('electrical_stations_types.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('electricalStationsTypes.index') }}" class="btn btn-default">
                 @lang('crud.cancel')
                </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
