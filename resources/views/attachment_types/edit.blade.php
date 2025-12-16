@extends('layouts.app')

@section('title', __('models/attachmentTypes.plural'))

@section('breadcrumbs', __('models/attachmentTypes.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($attachmentType, ['route' => ['attachmentTypes.update', $attachmentType->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/attachmentTypes.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'attachmentTypes','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('attachment_types.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('attachmentTypes.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection