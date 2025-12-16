@extends('layouts.app')

@section('title', __('models/assayServices.plural'))

@section('breadcrumbs', __('models/assayServices.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/assayServices.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'assayServices','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('assay_services.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
