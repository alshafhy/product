@include('work_orders.details.edit.fixed_info')

<div class="row"><br></div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/workOrders.fields.reference_number') }} </span>
             &nbsp;
             <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $workOrder->reference_number }}
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
            {{ $workOrder->district->name }}
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
             {{ $workOrder->customer_number }}
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
             {{ $workOrder->customer_name }}
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
             {{ $workOrder->electrical_station_number }}
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
             {{ $workOrder->consultant->name ?? '' }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/electricityCompanyEmployees.singular') }} </span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $workOrder->electricity_company_employees->name ?? '' }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 fw-bolder d-flex">
            <span class="fw-bolder text-primary">{{  __('models/workOrders.fields.userCreatedBy') }} </span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
             {{ $workOrder->user->name ?? '' }}
        </div>
    </div>
</div>

{{-- <!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/workOrders.fields.id').':') !!}
    <p>{{ $workOrder->id }}</p>
</div>

<!-- Work Order Number Field -->
<div class="col-sm-12">
    {!! Form::label('work_order_number', __('models/workOrders.fields.work_order_number').':') !!}
    <p>{{ $workOrder->work_order_number }}</p>
</div>

<!-- Reference Number Field -->
<div class="col-sm-12">
    {!! Form::label('reference_number', __('models/workOrders.fields.reference_number').':') !!}
    <p>{{ $workOrder->reference_number }}</p>
</div>

<!-- Received Date Field -->
<div class="col-sm-12">
    {!! Form::label('received_date', __('models/workOrders.fields.received_date').':') !!}
    <p>{{ $workOrder->received_date }}</p>
</div>

<!-- Work Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('work_type_id', __('models/workOrders.fields.work_type_id').':') !!}
    <p>{{ $workOrder->work_type_id }}</p>
</div>

<!-- Branch Id Field -->
<div class="col-sm-12">
    {!! Form::label('branch_id', __('models/workOrders.fields.branch_id').':') !!}
    <p>{{ $workOrder->branch_id }}</p>
</div>

<!-- City Id Field -->
<div class="col-sm-12">
    {!! Form::label('city_id', __('models/workOrders.fields.city_id').':') !!}
    <p>{{ $workOrder->city_id }}</p>
</div>

<!-- District Id Field -->
<div class="col-sm-12">
    {!! Form::label('district_id', __('models/workOrders.fields.district_id').':') !!}
    <p>{{ $workOrder->district_id }}</p>
</div>

<!-- X Axis Field -->
<div class="col-sm-12">
    {!! Form::label('x_axis', __('models/workOrders.fields.x_axis').':') !!}
    <p>{{ $workOrder->x_axis }}</p>
</div>

<!-- Y Axis Field -->
<div class="col-sm-12">
    {!! Form::label('y_axis', __('models/workOrders.fields.y_axis').':') !!}
    <p>{{ $workOrder->y_axis }}</p>
</div>

<!-- Street Name Field -->
<div class="col-sm-12">
    {!! Form::label('street_name', __('models/workOrders.fields.street_name').':') !!}
    <p>{{ $workOrder->street_name }}</p>
</div>

<!-- Customer Number Field -->
<div class="col-sm-12">
    {!! Form::label('customer_number', __('models/workOrders.fields.customer_number').':') !!}
    <p>{{ $workOrder->customer_number }}</p>
</div>

<!-- Customer Name Field -->
<div class="col-sm-12">
    {!! Form::label('customer_name', __('models/workOrders.fields.customer_name').':') !!}
    <p>{{ $workOrder->customer_name }}</p>
</div>

<!-- Electrical Station Number Field -->
<div class="col-sm-12">
    {!! Form::label('electrical_station_number', __('models/workOrders.fields.electrical_station_number').':') !!}
    <p>{{ $workOrder->electrical_station_number }}</p>
</div>

<!-- Electrical Stations Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('electrical_stations_type_id', __('models/workOrders.fields.electrical_stations_type_id').':') !!}
    <p>{{ $workOrder->electrical_stations_type_id }}</p>
</div>

<!-- Work Period Field -->
<div class="col-sm-12">
    {!! Form::label('work_period', __('models/workOrders.fields.work_period').':') !!}
    <p>{{ $workOrder->work_period }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/workOrders.fields.status').':') !!}
    <p>{{ $workOrder->status }}</p>
</div>

<!-- Work Orders Stage Id Field -->
<div class="col-sm-12">
    {!! Form::label('work_orders_stage_id', __('models/workOrders.fields.work_orders_stage_id').':') !!}
    <p>{{ $workOrder->work_orders_stage_id }}</p>
</div>

<!-- Electricity Department Id Field -->
<div class="col-sm-12">
    {!! Form::label('electricity_department_id', __('models/workOrders.fields.electricity_department_id').':') !!}
    <p>{{ $workOrder->electricity_department_id }}</p>
</div>

<!-- Current Department Id Field -->
<div class="col-sm-12">
    {!! Form::label('current_department_id', __('models/workOrders.fields.current_department_id').':') !!}
    <p>{{ $workOrder->current_department_id }}</p>
</div>

<!-- Needs Drilling Operations Field -->
<div class="col-sm-12">
    {!! Form::label('needs_drilling_operations', __('models/workOrders.fields.needs_drilling_operations').':') !!}
    <p>{{ $workOrder->needs_drilling_operations }}</p>
</div>

<!-- Needs Electrical Work Field -->
<div class="col-sm-12">
    {!! Form::label('needs_electrical_work', __('models/workOrders.fields.needs_electrical_work').':') !!}
    <p>{{ $workOrder->needs_electrical_work }}</p>
</div>

<!-- Needs Work Orders Permit Field -->
<div class="col-sm-12">
    {!! Form::label('needs_work_orders_permit', __('models/workOrders.fields.needs_work_orders_permit').':') !!}
    <p>{{ $workOrder->needs_work_orders_permit }}</p>
</div>

<!-- Needs Program Field -->
<div class="col-sm-12">
    {!! Form::label('needs_program', __('models/workOrders.fields.needs_program').':') !!}
    <p>{{ $workOrder->needs_program }}</p>
</div>

<!-- Finished Date Field -->
<div class="col-sm-12">
    {!! Form::label('finished_date', __('models/workOrders.fields.finished_date').':') !!}
    <p>{{ $workOrder->finished_date }}</p>
</div>

<!-- Has Asbuilt Field -->
<div class="col-sm-12">
    {!! Form::label('has_asbuilt', __('models/workOrders.fields.has_asbuilt').':') !!}
    <p>{{ $workOrder->has_asbuilt }}</p>
</div>

<!-- Asbuilt Number Field -->
<div class="col-sm-12">
    {!! Form::label('asbuilt_number', __('models/workOrders.fields.asbuilt_number').':') !!}
    <p>{{ $workOrder->asbuilt_number }}</p>
</div>

<!-- Achievement Certificate Id Field -->
<div class="col-sm-12">
    {!! Form::label('achievement_certificate_id', __('models/workOrders.fields.achievement_certificate_id').':') !!}
    <p>{{ $workOrder->achievement_certificate_id }}</p>
</div>

<!-- Payment Clearance Id Field -->
<div class="col-sm-12">
    {!! Form::label('payment_clearance_id', __('models/workOrders.fields.payment_clearance_id').':') !!}
    <p>{{ $workOrder->payment_clearance_id }}</p>
</div>

<!-- Work Orders Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('work_orders_type_id', __('models/workOrders.fields.work_orders_type_id').':') !!}
    <p>{{ $workOrder->work_orders_type_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/workOrders.fields.created_at').':') !!}
    <p>{{ $workOrder->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/workOrders.fields.updated_at').':') !!}
    <p>{{ $workOrder->updated_at }}</p>
</div>
 --}}
