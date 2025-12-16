@extends('layouts.app')

@section('title', __('models/achievementCertificates.plural'))

@section('breadcrumbs', __('models/achievementCertificates.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'achievementCertificates.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/achievementCertificates.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'achievementCertificates','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('achievement_certificates.fields')
                </div>
            </div>

            <div class="card-footer">
                <x-form-submit-buttons screenname="achievementCertificates" cancelroute="achievementCertificates.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
