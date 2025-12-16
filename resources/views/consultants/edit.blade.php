@extends('layouts.app')

@section('title', __('models/consultants.plural'))

@section('breadcrumbs', __('models/consultants.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($consultant, ['route' => ['consultants.update', $consultant->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/consultants.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'consultants','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('consultants.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('consultants.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection