@extends('layouts.app')

@section('title', __('models/workOrderTransactionsHistories.plural'))

@section('breadcrumbs', __('models/workOrderTransactionsHistories.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    
                                @lang('models/workOrderTransactionsHistories.singular') - @lang('crud.show')
                 
                </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrderTransactionsHistories','action_name' => 'show'])
            </div>
            <div class="card-body border-top">
                <div class="row"  style="padding-top: 20px;">
                    @include('work_order_transactions_histories.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
