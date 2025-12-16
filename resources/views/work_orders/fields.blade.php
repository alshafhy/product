<!-- Work Order Number Field -->
@if ($formMode=="create")
    <div class="form-group col-sm-4">
        {!! Form::label('work_order_number', __('models/workOrders.fields.work_order_number').':') !!}
        {!! Form::text('work_order_number', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Work Type Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('work_type_id', __('models/workOrders.fields.work_type_name').':') !!}
        {!! Form::select('work_type_id', $workTypes,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
    <!-- Received Date Field -->
    <div class="form-group col-sm-4">
        <x-date-pickr name="received_date" :labelTitle="__('models/workOrders.fields.received_date')"></x-date-pickr>
    </div>
@else
    @include('work_orders.details.edit.fixed_info')
    <div class="row"></div>
@endif



<!-- Reference Number Field -->
<div class="form-group col-sm-4">
    {!! Form::label('reference_number', __('models/workOrders.fields.reference_number').':') !!}
    {!! Form::text('reference_number', null, ['class' => 'form-control']) !!}
</div>

<!-- District Id Field -->
<div class="form-group col-sm-4">
    <x-select2 name="district_id" :options="$districts" :labelTitle="__('models/workOrders.fields.district_name')"></x-select2>
</div>

<!-- Street Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('street_name', __('models/workOrders.fields.street_name').':') !!}
    {!! Form::text('street_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Number Field -->
<div class="form-group col-sm-4">
    {!! Form::label('customer_number', __('models/workOrders.fields.customer_number').':') !!}
    {!! Form::text('customer_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('customer_name', __('models/workOrders.fields.customer_name').':') !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Electrical Station Number Field -->
<div class="form-group col-sm-4">
    {!! Form::label('electrical_station_number', __('models/workOrders.fields.electrical_station_number').':') !!}
    {!! Form::text('electrical_station_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Electrical Stations Type Id Field -->
<div class="form-group col-sm-4">
    <x-select2 name="electrical_stations_type_id" :options="$electricalStationsTypes" :labelTitle="__('models/workOrders.fields.electrical_stations_type_name')"></x-select2>
</div>

<div class="form-group col-sm-4">
    <x-select2 name="consultant_id" :options="$consultants" :labelTitle="__('models/workOrders.fields.consultant_name')"></x-select2>
</div>
<!-- Electricity Department Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('electricity_department_id', __('models/workOrders.fields.electricity_department_name').':') !!}
    {!! Form::select('electricity_department_id', $electricityDepartments,null, ['class' => 'select2 form-select form-control']) !!}
</div>

<div class="form-group col-sm-4">
    <x-select2 name="work_orders_type_id" :options="$workOrdersTypes" :labelTitle="__('models/workOrders.fields.work_orders_type_name')"></x-select2>
</div>

<div class="form-group col-sm-4">
    <x-select2 name="electricity_company_employee_id" :options="$electricityCompanyEmployees" :labelTitle="__('models/workOrders.fields.electricity_company_employee')"></x-select2>
</div>
<!-- Work Period Field -->
<div class="form-group col-sm-4">
    <x-number-touch-spin name="work_period" defaultValue="{{$workPeriodDefaultValue ?? ''}}" :labelTitle="__('models/workOrders.fields.work_period')"></x-number-touch-spin>
</div>


<!-- Electrical Station Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notes', __('models/workOrders.fields.notes').':') !!}
    {!! Form::textArea('notes', null, ['class' => 'form-control', 'rows'=>'3']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/workOrders.fields.description').':') !!}
    {!! Form::textArea('description', null, ['class' => 'form-control','rows'=>3]) !!}
</div>


<!-- Branch Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('branch_id', __('models/workOrders.fields.branch_id').':') !!}
    {!! Form::text('branch_id', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- City Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/workOrders.fields.city_id').':') !!}
    {!! Form::text('city_id', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- X Axis Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('x_axis', __('models/workOrders.fields.x_axis').':') !!}
    {!! Form::text('x_axis', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Y Axis Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('y_axis', __('models/workOrders.fields.y_axis').':') !!}
    {!! Form::text('y_axis', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Status Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('status', __('models/workOrders.fields.status').':') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Work Orders Stage Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('work_orders_stage_id', __('models/workOrders.fields.work_orders_stage_id').':') !!}
    {!! Form::text('work_orders_stage_id', null, ['class' => 'form-control']) !!}
</div> --}}



<!-- Current Department Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('current_department_id', __('models/workOrders.fields.current_department_id').':') !!}
    {!! Form::text('current_department_id', null, ['class' => 'form-control']) !!}
</div> --}}


<!-- Current Department Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('current_department_id', __('models/workOrders.fields.current_department_id').':') !!}
    {!! Form::text('current_department_id', null, ['class' => 'form-control']) !!}
</div> --}}


<!-- 'bootstrap / Toggle Switch Needs Work Orders Permit Field' -->
{{-- <div class="form-group col-sm-6">

    {!! Form::label('needs_work_orders_permit', __('models/workOrders.fields.needs_work_orders_permit').':') !!}
    {!! Form::hidden('needs_work_orders_permit', 0) !!}
    {!! Form::checkbox('needs_work_orders_permit', 1, null,  ['data-bootstrap-switch']) !!}
</div> --}}



<!-- 'bootstrap / Toggle Switch Needs Program Field' -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('needs_program', __('models/workOrders.fields.needs_program').':') !!}
    {!! Form::hidden('needs_program', 0) !!}
    {!! Form::checkbox('needs_program', 1, null,  ['data-bootstrap-switch']) !!}
</div> --}}



<!-- Finished Date Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('finished_date', __('models/workOrders.fields.finished_date').':') !!}
    {!! Form::text('finished_date', null, ['class' => 'form-control','id'=>'finished_date']) !!}
</div> --}}



<!-- 'bootstrap / Toggle Switch Has Asbuilt Field' -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('has_asbuilt', __('models/workOrders.fields.has_asbuilt').':') !!}
    {!! Form::hidden('has_asbuilt', 0) !!}
    {!! Form::checkbox('has_asbuilt', 1, null,  ['data-bootstrap-switch']) !!}
</div> --}}



<!-- Asbuilt Number Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('asbuilt_number', __('models/workOrders.fields.asbuilt_number').':') !!}
    {!! Form::text('asbuilt_number', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Achievement Certificate Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('achievement_certificate_id', __('models/workOrders.fields.achievement_certificate_id').':') !!}
    {!! Form::text('achievement_certificate_id', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Payment Clearance Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('payment_clearance_id', __('models/workOrders.fields.payment_clearance_id').':') !!}
    {!! Form::text('payment_clearance_id', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Work Orders Type Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('work_orders_type_id', __('models/workOrders.fields.work_orders_type_id').':') !!}
    {!! Form::text('work_orders_type_id', null, ['class' => 'form-control']) !!}
</div> --}}
@if ($formMode=="edit")
    @include('work_orders.details.edit.details')
@endif

