@extends('layouts.app')

@section('title', __('models/servicesCategories.plural'))

@section('breadcrumbs', __('models/servicesCategories.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($servicesCategory, ['route' => ['servicesCategories.update', $servicesCategory->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/servicesCategories.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'servicesCategories','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('services_categories.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('servicesCategories.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection