@extends('layouts.app')

@section('title', __('models/missionTypes.plural'))

@section('breadcrumbs', __('models/missionTypes.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($missionType, ['route' => ['missionTypes.update', $missionType->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/missionTypes.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'missionTypes','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('mission_types.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('missionTypes.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection