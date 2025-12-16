@extends('layouts.app')

@section('title', __('models/assayItems.plural'))

@section('breadcrumbs', __('models/assayItems.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'assayItems.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/assayItems.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'assayItems','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('assay_items.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('assayItems.index') }}" class="btn btn-default">
                 @lang('crud.cancel')
                </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
