@extends('layouts.app')

@section('title', __('models/systemReleases.plural'))

@section('breadcrumbs', __('models/systemReleases.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    
                                @lang('models/systemReleases.singular') - @lang('crud.show')
                 
                </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'systemReleases','action_name' => 'show'])
            </div>
            <div class="card-body border-top">
                <div class="row"  style="padding-top: 20px;">
                    @include('system_releases.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
