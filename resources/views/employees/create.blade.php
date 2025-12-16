@extends('layouts.app')

@section('title', __('models/employees.plural'))

@section('breadcrumbs', __('models/employees.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'employees.store']) !!}
            <div class="card-header border-bottom">
                <h4 class="card-title">{{  __('models/employees.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'employees','action_name' => 'create'])
            </div>
             
            <div class="card-body border-bottom">
                <div class="row">
                    @include('employees.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('employees.index') }}" class="btn btn-default">
                 @lang('crud.cancel')
                </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
