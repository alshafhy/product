@extends('layouts.app')

@section('title', __('models/workOrderServices.plural'))

@section('breadcrumbs', __('models/workOrderServices.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($workOrderService, ['route' => ['workOrderServices.update', $workOrderService->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrderServices.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrderServices','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_order_services.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('workOrderServices.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection