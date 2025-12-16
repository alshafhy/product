@extends('layouts.app')

@section('title', __('models/branches.plural'))

@section('breadcrumbs', __('models/branches.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/branches.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'branches','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('branches.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
