@extends('layouts.app')

@section('title', __('models/emergencyIssuesTypes.plural'))

@section('breadcrumbs', __('models/emergencyIssuesTypes.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    
                                @lang('models/emergencyIssuesTypes.singular') - @lang('crud.show')
                 
                </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'emergencyIssuesTypes','action_name' => 'show'])
            </div>
            <div class="card-body border-top">
                <div class="row"  style="padding-top: 20px;">
                    @include('emergency_issues_types.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
