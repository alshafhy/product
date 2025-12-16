@extends('layouts.app')

@section('title', __('models/contractors.plural'))

@section('breadcrumbs', __('models/contractors.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'contractors.store', 'files' => true]) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/contractors.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'contractors','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('contractors.fields')
                </div>
            </div>
            {{-- <x-attachment.files
                :required="['title','file','category']"
            ></x-attachment.files> --}}
            <x-attachment.files
                :required="[]"
            ></x-attachment.files>
            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('contractors.index') }}" class="btn btn-default">
                 @lang('crud.cancel')
                </a>
            </div>

            

            {!! Form::close() !!}

        </div>
    </div>
@endsection
