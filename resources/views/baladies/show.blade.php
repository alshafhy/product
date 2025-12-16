@extends('layouts.app')

@section('title', __('models/baladies.plural'))

@section('breadcrumbs', __('models/baladies.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">{{  __('models/baladies.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'baladies','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('baladies.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
