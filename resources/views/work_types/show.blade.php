@extends('layouts.app')

@section('title', __('models/workTypes.plural'))

@section('breadcrumbs', __('models/workTypes.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workTypes.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workTypes','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_types.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
