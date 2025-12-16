@extends('layouts.app')

@section('title', __('models/workOrdersPermitTypes.plural'))

@section('breadcrumbs', __('models/workOrdersPermitTypes.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($workOrdersPermitType, ['route' => ['workOrdersPermitTypes.update', $workOrdersPermitType->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersPermitTypes.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersPermitTypes','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders_permit_types.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('workOrdersPermitTypes.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection