@include('emergency_missions.details.edit.fixed_info')
<!-- Id Field -->
{{-- <div class="col-sm-12">
    {!! Form::label('id', __('models/emergencyMissions.fields.id').':') !!}
    <p>{{ $emergencyMission->id }}</p>
</div>

<!-- Work Order Number Field -->
<div class="col-sm-12">
    {!! Form::label('work_order_number', __('models/emergencyMissions.fields.work_order_number').':') !!}
    <p>{{ $emergencyMission->work_order_number }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/emergencyMissions.fields.created_at').':') !!}
    <p>{{ $emergencyMission->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/emergencyMissions.fields.updated_at').':') !!}
    <p>{{ $emergencyMission->updated_at }}</p>
</div> --}}
<div class="row"><br></div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/workOrders.fields.reference_number') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $emergencyMission->reference_number }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/workOrders.fields.district_name') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $emergencyMission->district->name ?? '' }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/workOrders.fields.customer_number') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $emergencyMission->customer_number }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/workOrders.fields.customer_name') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $emergencyMission->customer_name }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/workOrders.fields.electrical_station_number') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $emergencyMission->electrical_station_number }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/workOrders.fields.consultant_name') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $emergencyMission->consultant->name ?? '' }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/emergencyMissions.fields.id') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $emergencyMission->id ?? '' }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/emergencyMissions.fields.mission_number') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{-- @dd($emergencyMission) --}}
             {{$emergencyMission->mission_number}}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/emergencyMissions.fields.electricity_company_employee_id') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{$emergencyMission->electricityCompanyEmployees->name ?? ''}}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/emergencyMissions.fields.created_by') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{$emergencyMission->users->name ?? ''}}
        </div>
    </div>
</div>
{{-- <div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/emergencyMissions.fields.created_at') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $emergencyMission->created_at ?? '' }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/emergencyMissions.fields.updated_at') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $emergencyMission->updated_at ?? '' }}
        </div>
    </div>
</div> --}}

