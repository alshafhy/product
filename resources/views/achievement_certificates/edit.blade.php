@extends('layouts.app')

@section('title', __('models/achievementCertificates.plural'))

@section('breadcrumbs', __('models/achievementCertificates.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($achievementCertificate, ['route' => ['achievementCertificates.update', $achievementCertificate->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/achievementCertificates.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'achievementCertificates','action_name' => 'edit'])
                <div class="demo-inline-spacing">
                    @if($achievementCertificate->status == \App\Http\Controllers\AchievementCertificateController::NEW_COC)
                        <a class="btn btn-primary float-end" href="{{route("achievementCertificates.approval",['id'=>$achievementCertificate->id])}}">
                            إعتماد الشهادة
                        </a>
                    @endif

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('achievement_certificates.fields')
                </div>
            </div>
            <div class="card-footer">
                @if($achievementCertificate->status == \App\Http\Controllers\AchievementCertificateController::NEW_COC)
                    <x-form-submit-buttons screenname="achievementCertificates" cancelroute="achievementCertificates.index"></x-form-submit-buttons>
                @else
                {{-- TODO: REview This --}}
                <x-form-submit-buttons screenname="achievementCertificates" cancelroute="achievementCertificates.index"></x-form-submit-buttons>
                    {{-- <a href="{{ route('achievementCertificates.index') }}" class="btn btn-default">
                        @lang('crud.cancel')
                    </a> --}}
                @endif
                
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
