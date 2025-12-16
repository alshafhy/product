@extends('layouts.app')

@section('title', __('models/units.plural'))

@section('breadcrumbs', __('models/units.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/units.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'units','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('units.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
