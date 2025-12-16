@extends('layouts.app')

@section('title', __('models/returnSituations.plural'))

@section('breadcrumbs', __('models/returnSituations.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/returnSituations.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'returnSituations','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('return_situations.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
