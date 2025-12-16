@extends('layouts.app')

@section('title', __('models/electricalStationsTypes.plural'))

@section('breadcrumbs', __('models/electricalStationsTypes.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/electricalStationsTypes.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'electricalStationsTypes','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('electrical_stations_types.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
