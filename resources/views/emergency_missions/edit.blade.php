@extends('layouts.app')

@section('title', __('models/emergencyMissions.plural'))

@section('breadcrumbs', __('models/emergencyMissions.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">


            <div class="card-header">
                <h4 class="card-title">{{  __('models/emergencyMissions.plural') }} - @lang('crud.edit')  </h4>
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'emergencyMissions','action_name' => 'edit']) --}}
                <x-form-toolbar screenname="emergencyMissions" actionname='edit' :key="$emergencyMission->id">
                    <x-slot:before class="font-bold">


                        @if ( $emergencyMission->status == 1 || $emergencyMission->status == 2)
                            {!! Form::open(['route' => ['emergencyMissions.changeStatus',"restablishWorkInProgress",  $emergencyMission->id,"emergencyMissions"], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="تحويل الى جارى  أعمال الطوارئ">
                                    تحويل الى جارى  الاعمال
                                </button>
                            {!! Form::close() !!}

                        @endif
                        @if ( $emergencyMission->status == 3 && !$emergencyMission->electrical_operations_status )
                            {!! Form::open(['route' => ['emergencyMissions.changeStatus',"restablishWorkFinished" , $emergencyMission->id,"emergencyMissions"], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="انتهاء أعمال الطوارئ">
                                    تحويل الى انتهاء أعمال الطوارئ
                                </button>
                            {!! Form::close() !!}
                        @endif
{{--                            @if ( $emergencyMission->status == 3 && $emergencyMission->drilling_status == 2 && $emergencyMission->current_department_id != 4  )--}}
                        @if ( $emergencyMission->status == 3 && $emergencyMission->current_department_id <> 4  )
                            {!! Form::open(['route' => ['emergencyMissions.changeStatus',"convertDepartment" , $emergencyMission->id,"emergencyMissions"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="الارسال الى اعادة الوضع">
                                الارسال الى اعادة الوضع -وانهاء العمل 
                            </button>
                            {!! Form::close() !!}
                        @endif
                    </x-slot>
                </x-form-toolbar>
            </div>

            {!! Form::model($emergencyMission, ['route' => ['emergencyMissions.update', $emergencyMission->id], 'method' => 'patch']) !!}
            <div class="card-body">
                <div class="row">
                    @include('emergency_missions.fields', ["formMode"=>"edit"])
                </div>
            </div>

            {{-- <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('emergencyMissions.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div> --}}
            <div class="card-footer">
                <x-form-submit-buttons screenname="emergencyMissions" cancelroute="emergencyMissions.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}
            @include('emergency_missions.tabs.attachment_add_modal')

        </div>
    </div>
    @if(!$emergencyMission->parent_id)
        @include('emergency_missions.convert_to_work_order')
    @endif
@endsection
