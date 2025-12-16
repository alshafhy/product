@extends('layouts.app')

@section('title', __('models/electricityDepartments.plural'))

@section('breadcrumbs', __('models/electricityDepartments.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/electricityDepartments.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'electricityDepartments','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('electricity_departments.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
