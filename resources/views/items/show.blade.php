@extends('layouts.app')

@section('title', __('models/items.plural'))

@section('breadcrumbs', __('models/items.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/items.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'items','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('items.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
