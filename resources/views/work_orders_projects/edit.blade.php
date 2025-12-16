@extends('layouts.app')

@section('title', __('models/workOrdersProjects.plural'))

@section('breadcrumbs', __('models/workOrdersProjects.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')
        @include('flash::message')

        <div class="card">


            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersProjects.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersProjects','action_name' => 'edit'])
                <div class="demo-inline-spacing">
                    {!! Form::open(['route' => ['workOrdersProjects.close',  $workOrdersProject->id], 'method' => 'post']) !!}
                    <button type="submit" class="btn btn-outline-danger me-75 round"  title="إغلاق المشروع">
                        إغلاق المشروع
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
            {!! Form::model($workOrdersProject, ['route' => ['workOrdersProjects.update', $workOrdersProject->id], 'method' => 'patch']) !!}
            <div class="card-body">
                <div class="row">
                    @include('work_orders_projects.fields', ["formMode"=>"edit"])
                </div>
                <div class="row">
                    @include('work_orders_projects.work_orders')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('workOrdersProjects.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
