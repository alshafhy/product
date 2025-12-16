@extends('layouts.app')

@section('title', __('models/users.plural'))

@section('breadcrumbs', __('models/users.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/users.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'users','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('users.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
