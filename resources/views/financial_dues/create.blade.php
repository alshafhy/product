@extends('layouts.app')

@section('title', __('models/financialDues.plural'))

@section('breadcrumbs', __('models/financialDues.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'financialDues.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/financialDues.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'financialDues','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('financial_dues.fields')
                </div>
            </div>

            <div class="card-footer">
                <x-form-submit-buttons screenname="financialDues" cancelroute="financialDues.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
