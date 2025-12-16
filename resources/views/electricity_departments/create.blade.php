@extends('layouts.app')

@section('title', __('models/electricityDepartments.plural'))

@section('breadcrumbs', __('models/electricityDepartments.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'electricityDepartments.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/electricityDepartments.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'electricityDepartments','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('electricity_departments.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('electricityDepartments.index') }}" class="btn btn-default">
                 @lang('crud.cancel')
                </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
