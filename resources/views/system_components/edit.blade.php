@extends('layouts.app')

@section('title', __('models/systemComponents.plural'))

@section('breadcrumbs', __('models/systemComponents.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($systemComponent, ['route' => ['systemComponents.update', $systemComponent->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/systemComponents.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'systemComponents','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('system_components.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('systemComponents.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection