@extends('layouts.app')

@section('title', __('models/electricityCompanyEmployees.plural'))

@section('breadcrumbs', __('models/electricityCompanyEmployees.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    
                                @lang('models/electricityCompanyEmployees.singular') - @lang('crud.show')
                 
                </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'electricityCompanyEmployees','action_name' => 'show'])
            </div>
            <div class="card-body border-top">
                <div class="row"  style="padding-top: 20px;">
                    @include('electricity_company_employees.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
