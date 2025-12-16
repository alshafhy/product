@extends('layouts.app')

@section('title', __('models/employees.plural'))

@section('breadcrumbs', __('models/employees.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> @lang('crud.show') - {{  __('models/employees.plural') }}  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'employees','action_name' => 'show'])
            </div>
            <div class="card-body border-top">
                <div class="row " style="padding-top: 20px;">
                    @include('employees.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
