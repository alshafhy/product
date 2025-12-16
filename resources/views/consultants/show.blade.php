@extends('layouts.app')

@section('title', __('models/consultants.plural'))

@section('breadcrumbs', __('models/consultants.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/consultants.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'consultants','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('consultants.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
