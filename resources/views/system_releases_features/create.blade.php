@extends('layouts.app')
@section('title', __('models/systemReleasesFeatures.plural'))

@section('breadcrumbs', __('models/systemReleasesFeatures.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'systemReleasesFeatures.store']) !!}
            <div class="card-header">
                
                <h4 class="card-title">
                                @lang('models/systemReleasesFeatures.singular') - @lang('crud.add_new')
                 
                </h4>
                
                @include('layouts.partials.form_toolbar', ['screen_name' => 'systemReleasesFeatures','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('system_releases_features.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('systemReleasesFeatures.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
