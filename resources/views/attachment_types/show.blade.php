@extends('layouts.app')

@section('title', __('models/attachmentTypes.plural'))

@section('breadcrumbs', __('models/attachmentTypes.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/attachmentTypes.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'attachmentTypes','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('attachment_types.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
