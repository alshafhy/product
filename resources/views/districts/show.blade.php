@extends('layouts.app')

@section('title', __('models/districts.plural'))

@section('breadcrumbs', __('models/districts.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/districts.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'districts','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('districts.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
