@extends('layouts.app')

@section('title', __('models/returnSituations.plural'))

@section('breadcrumbs', __('models/returnSituations.plural'))

@section('content')

<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($returnSituation, ['route' => ['returnSituations.update', $returnSituation->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/returnSituations.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'returnSituations','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('return_situations.fields' , ["formMode"=>"edit"])
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('returnSituations.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}


            <div class="card-body">
                <div class="row">
                    @include('return_situations.ajax_modals.land_layers_modals')
                </div>
            </div>
            
            @section("page-script")
                <script src="{{ asset(mix('js/scripts/pages/app-returnSituations-edit.js')) }}"></script>
            @endsection


        </div>
    </div>
@endsection