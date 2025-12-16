@extends('layouts.app')

@section('title', __('models/assayForms.plural'))

@section('breadcrumbs', __('models/assayForms.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'assayForms.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/assayForms.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'assayForms','action_name' => 'create'])
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

        </div>
    </div>
@endsection
