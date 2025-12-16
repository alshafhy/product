@extends('layouts.app')

@section('title', __('models/labs.plural'))

@section('breadcrumbs', __('models/labs.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/labs.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'labs','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('labs.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
