@extends('layouts.app')

@section('title', __('models/financialDueTypes.plural'))

@section('breadcrumbs', __('models/financialDueTypes.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/financialDueTypes.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'financialDueTypes','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('financial_due_types.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
