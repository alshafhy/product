@extends('layouts.app')

@section('title', __('models/emergencyIssuesTypes.plural'))

@section('breadcrumbs', __('models/emergencyIssuesTypes.plural'))


@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($emergencyIssuesType, ['route' => ['emergencyIssuesTypes.update', $emergencyIssuesType->id], 'method' => 'patch']) !!}
            <div class="card-header">
                
                <h4 class="card-title">
                                        @lang('models/emergencyIssuesTypes.singular') - @lang('crud.edit')
                     
                </h4>
                
                @include('layouts.partials.form_toolbar', ['screen_name' => 'emergencyIssuesTypes','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('emergency_issues_types.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('emergencyIssuesTypes.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
