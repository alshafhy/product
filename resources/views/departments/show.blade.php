@extends('layouts.app')

@section('title', __('models/departments.plural'))

@section('breadcrumbs', __('models/departments.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/departments.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'departments','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('departments.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
