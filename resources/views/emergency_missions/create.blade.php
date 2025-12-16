@extends('layouts.app')

@section('title', __('models/emergencyMissions.plural'))

@section('breadcrumbs', __('models/emergencyMissions.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'emergencyMissions.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/emergencyMissions.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'emergencyMissions','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('emergency_missions.fields', ["formMode"=>"create"])
                </div>
            </div>

            {{-- <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('emergencyMissions.index') }}" class="btn btn-default">
                 @lang('crud.cancel')
                </a>
            </div> --}}
            <div class="card-footer">
                <x-form-submit-buttons screenname="emergencyMissions" cancelroute="emergencyMissions.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
