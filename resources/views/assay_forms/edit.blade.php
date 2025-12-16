@extends('layouts.app')

@section('title', __('models/assayForms.plural'))

@section('breadcrumbs', __('models/assayForms.plural'))

@section('content')
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>

    <style>
        form label {font-weight:bold}
    </style>

    <div>

        @include('layouts.partials.messages')
        @include('flash::message')

        <div class="card">

            {!! Form::model($assayForm, ['route' => ['assayForms.update', $assayForm->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/assayForms.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'assayForms','action_name' => 'edit'])
                <div class="demo-inline-spacing">
                    @if($assayForm->status == \App\Http\Controllers\AssayFormController::NEW_ASSAY)
                        <a class="btn btn-primary float-end" href="{{route("assayForms.approval",['id'=>$assayForm->id])}}">
                            إعتماد المقايسة
                        </a>
                    @else
                        <div class="btn btn-outline-secondary float-end">
                            {!! Form::label('notes', __('models/assayForms.fields.status').': ') !!}
                            <span class="badge rounded-pill {{config('const.assay_form')[$assayForm->status]['class']}}">
                            {{config('const.assay_form')[$assayForm->status]['title']}}
                            </span>
                        </div>
                    @endif
                        <div class="btn btn-outline-secondary float-end">
                            {!! Form::label('notes', __('models/assayForms.fields.created_at').': ') !!}
                              {{$assayForm->created_at}}
                        </div>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('assay_forms.fields')
                </div>
            </div>

            <div class="card-footer">
                <x-form-submit-buttons screenname="assayForms" cancelroute="assayForms.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}

            <div class="card-body">
                <div class="row">
                    @include('assay_forms.ajax_modals.services_modals')
                    @include('assay_forms.ajax_modals.items_modals')
                </div>
            </div>

        </div>
    </div>
@endsection
@section("page-script")
    <script src="{{ asset(mix('js/scripts/pages/app-AssayForm-edit.js')) }}"></script>
@endsection
