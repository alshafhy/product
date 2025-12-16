@extends('layouts.app')

@section('title', __('models/assayServices.plural'))

@section('breadcrumbs', __('models/assayServices.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($assayService, ['route' => ['assayServices.update', $assayService->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/assayServices.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'assayServices','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('assay_services.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('assayServices.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection