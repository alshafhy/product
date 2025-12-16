@extends('layouts.app')
@section('title', __('models/workOrderTransactionsHistories.plural'))

@section('breadcrumbs', __('models/workOrderTransactionsHistories.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'workOrderTransactionsHistories.store']) !!}
            <div class="card-header">
                
                <h4 class="card-title">
                                @lang('models/workOrderTransactionsHistories.singular') - @lang('crud.add_new')
                 
                </h4>
                
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrderTransactionsHistories','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('work_order_transactions_histories.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('workOrderTransactionsHistories.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
