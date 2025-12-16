<div>

    {{-- @include('layouts.partials.messages') --}}

    <div class="card">

        {!! Form::model($emergencyMission, ['route' => ['emergencyMissions.convertToWorkOrder', $emergencyMission->id], 'method' => 'post']) !!}
        <div class="card-header">
            <h4 class="card-title">{{  __('models/emergencyMissions.convert_to_work_order') }} - @lang('crud.add_new') {{__('models/workOrders.singular')}} </h4>
            {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'emergencyMissions','action_name' => 'edit']) --}}
        </div>
        <div class="card-body">
            <div class="row">
                {{-- @include('emergency_missions.fields') --}}
                <div class="form-group col-sm-3">
                    {!! Form::label('work_order_number', __('models/emergencyMissions.fields.work_order_number').':') !!}
                    {!! Form::text('work_order_number', null, ['class' => 'form-control']) !!}
                </div>
                {{-- <div class="form-group col-sm-3">
                    <x-select2 name="mission_typeـid" :options="$missionTypes" :labelTitle="__('models/emergencyMissions.fields.mission_typeـid')"></x-select2> 
                </div> --}}
                <!-- Work Type Id Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('work_type_id', __('models/workOrders.fields.work_type_name').':') !!}
                    {!! Form::select('work_type_id', $workTypes,null, ['class' => 'select2 form-select form-control']) !!}
                </div>
                <!-- Work Type Id Field -->
                <div class="form-group col-sm-4">
                    <x-date-pickr name="received_date" :labelTitle="__('models/emergencyMissions.fields.received_date')"></x-date-pickr>
                </div>
            </div>
        </div>

        <div class="card-footer">
            {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('emergencyMissions.index') }}" class="btn btn-default">
                @lang('crud.cancel')
             </a>
        </div>

        {!! Form::close() !!}
        {{-- @include('emergency_missions.tabs.attachment_add_modal') --}}

    </div>
</div>
