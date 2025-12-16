@extends('layouts.app')

@section('title', __('models/layers.plural'))

@section('breadcrumbs', __('models/layers.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/layers.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'layers','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('layers.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
