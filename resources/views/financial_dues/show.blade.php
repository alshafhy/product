@extends('layouts.app')

@section('title', __('models/financialDues.plural'))

@section('breadcrumbs', __('models/financialDues.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/financialDues.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'financialDues','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('financial_dues.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
