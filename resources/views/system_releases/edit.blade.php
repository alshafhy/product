@extends('layouts.app')

@section('title', __('models/systemReleases.plural'))

@section('breadcrumbs', __('models/systemReleases.plural'))


@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($systemRelease, ['route' => ['systemReleases.update', $systemRelease->id], 'method' => 'patch']) !!}
            <div class="card-header">
                
                <h4 class="card-title">
                                        @lang('models/systemReleases.singular') - @lang('crud.edit')
                     
                </h4>
                
                @include('layouts.partials.form_toolbar', ['screen_name' => 'systemReleases','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('system_releases.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('systemReleases.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
