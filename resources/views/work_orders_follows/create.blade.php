@extends('layouts.app')

@section('title', __('models/workOrderFollows.plural'))

@section('breadcrumbs', __('models/workOrderFollows.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'workOrderFollows.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrderFollows.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrderFollows','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('work_orders_follows.fields')
                </div>
            </div>

            <div class="card-footer">
                <x-form-submit-buttons screenname="workOrderFollows" cancelroute="workOrderFollows.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
