@extends('layouts.app')

@section('title', __('models/systemReleasesFeatures.plural'))

@section('breadcrumbs', __('models/systemReleasesFeatures.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    
                                @lang('models/systemReleasesFeatures.singular') - @lang('crud.show')
                 
                </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'systemReleasesFeatures','action_name' => 'show'])
            </div>
            <div class="card-body border-top">
                <div class="row"  style="padding-top: 20px;">
                    @include('system_releases_features.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
