@extends('layouts.app')

@section('title', __('models/roles.plural'))

@section('breadcrumbs', __('models/roles.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/roles.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'roles','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('roles.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
