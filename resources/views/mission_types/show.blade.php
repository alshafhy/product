@extends('layouts.app')

@section('title', __('models/missionTypes.plural'))

@section('breadcrumbs', __('models/missionTypes.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/missionTypes.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'missionTypes','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('mission_types.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
