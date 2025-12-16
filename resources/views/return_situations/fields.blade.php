<style>
label{
    font-weight: bold;
}
</style>
@if($formMode == 'edit')
<!-- Id Field -->
<div class="col-sm-6">
    {!! Form::label('id', __('models/workOrders.fields.id').':') !!}
    <p>{{ $returnSituation->id }}</p>
</div>

<!-- Work Order Number Field -->
<div class="col-sm-6">
    {!! Form::label('work_order_number', __('models/workOrders.fields.work_order_number').':') !!}
    <p>{{ $returnSituation->work_order_number }}</p>
</div>

<!-- Reference Number Field -->
<div class="col-sm-6">
    {!! Form::label('reference_number', __('models/workOrders.fields.reference_number').':') !!}
    <p>{{ $returnSituation->reference_number }}</p>
</div>

<!-- Received Date Field -->
<div class="col-sm-6">
    {!! Form::label('received_date', __('models/workOrders.fields.received_date').':') !!}
    <p>{{ $returnSituation->received_date }}</p>
</div>

<hr class="invoice-spacing">

<!-- Work Type Id Field -->
<div class="col-sm-6">
    {!! Form::label('work_type_id', __('models/workOrders.fields.work_type_id').':') !!}
    <p>{{ $returnSituation->work_type_id }}</p>
</div>

<!-- Branch Id Field -->
<div class="col-sm-6">
    {!! Form::label('branch_id', __('models/workOrders.fields.branch_id').':') !!}
    <p>{{ $returnSituation->branch_id }}</p>
</div>

<!-- City Id Field -->
<div class="col-sm-6">
    {!! Form::label('city_id', __('models/workOrders.fields.city_id').':') !!}
    <p>{{ $returnSituation->city_id }}</p>
</div>

<!-- District Id Field -->
<div class="col-sm-6">
    {!! Form::label('district_id', __('models/workOrders.fields.district_id').':') !!}
    <p>{{ $returnSituation->district_id }}</p>
</div>

<hr class="invoice-spacing">

<!-- X Axis Field -->
<div class="col-sm-6">
    {!! Form::label('x_axis', __('models/workOrders.fields.x_axis').':') !!}
    <p>{{ $returnSituation->x_axis }}</p>
</div>

<!-- Y Axis Field -->
<div class="col-sm-6">
    {!! Form::label('y_axis', __('models/workOrders.fields.y_axis').':') !!}
    <p>{{ $returnSituation->y_axis }}</p>
</div>

<!-- Street Name Field -->
<div class="col-sm-6">
    {!! Form::label('street_name', __('models/workOrders.fields.street_name').':') !!}
    <p>{{ $returnSituation->street_name }}</p>
</div>

<!-- Customer Number Field -->
<div class="col-sm-6">
    {!! Form::label('customer_number', __('models/workOrders.fields.customer_number').':') !!}
    <p>{{ $returnSituation->customer_number }}</p>
</div>

<hr class="invoice-spacing">

<!-- Customer Name Field -->
<div class="col-sm-6">
    {!! Form::label('customer_name', __('models/workOrders.fields.customer_name').':') !!}
    <p>{{ $returnSituation->customer_name }}</p>
</div>

<!-- Electrical Station Number Field -->
<div class="col-sm-6">
    {!! Form::label('electrical_station_number', __('models/workOrders.fields.electrical_station_number').':') !!}
    <p>{{ $returnSituation->electrical_station_number }}</p>
</div>

<!-- Electrical Stations Type Id Field -->
<div class="col-sm-6">
    {!! Form::label('electrical_stations_type_id', __('models/workOrders.fields.electrical_stations_type_id').':') !!}
    <p>{{ $returnSituation->electrical_stations_type_id }}</p>
</div>

<!-- Work Period Field -->
<div class="col-sm-6">
    {!! Form::label('work_period', __('models/workOrders.fields.work_period').':') !!}
    <p>{{ $returnSituation->work_period }}</p>
</div>

<hr class="invoice-spacing">

<!-- Status Field -->
<div class="col-sm-6">
    {!! Form::label('status', __('models/workOrders.fields.status').':') !!}
    <p>{{ $returnSituation->status }}</p>
</div>

<!-- Work Orders Stage Id Field -->
<div class="col-sm-6">
    {!! Form::label('work_orders_stage_id', __('models/workOrders.fields.work_orders_stage_id').':') !!}
    <p>{{ $returnSituation->work_orders_stage_id }}</p>
</div>

<!-- Electricity Department Id Field -->
<div class="col-sm-6">
    {!! Form::label('electricity_department_id', __('models/workOrders.fields.electricity_department_id').':') !!}
    <p>{{ $returnSituation->electricity_department_id }}</p>
</div>

<!-- Current Department Id Field -->
<div class="col-sm-6">
    {!! Form::label('current_department_id', __('models/workOrders.fields.current_department_id').':') !!}
    <p>{{ $returnSituation->current_department_id }}</p>
</div>

<hr class="invoice-spacing">

<!-- Needs Drilling Operations Field -->
<div class="col-sm-6">
    {!! Form::label('needs_drilling_operations', __('models/workOrders.fields.needs_drilling_operations').':') !!}
    <p>{{ $returnSituation->needs_drilling_operations }}</p>
</div>

<!-- Needs Electrical Work Field -->
<div class="col-sm-6">
    {!! Form::label('needs_electrical_work', __('models/workOrders.fields.needs_electrical_work').':') !!}
    <p>{{ $returnSituation->needs_electrical_work }}</p>
</div>

<!-- Needs Work Orders Permit Field -->
<div class="col-sm-6">
    {!! Form::label('needs_work_orders_permit', __('models/workOrders.fields.needs_work_orders_permit').':') !!}
    <p>{{ $returnSituation->needs_work_orders_permit }}</p>
</div>

<!-- Needs Program Field -->
<div class="col-sm-6">
    {!! Form::label('needs_program', __('models/workOrders.fields.needs_program').':') !!}
    <p>{{ $returnSituation->needs_program }}</p>
</div>

<hr class="invoice-spacing">

<!-- Finished Date Field -->
<div class="col-sm-6">
    {!! Form::label('finished_date', __('models/workOrders.fields.finished_date').':') !!}
    <p>{{ $returnSituation->finished_date }}</p>
</div>

<!-- Has Asbuilt Field -->
<div class="col-sm-6">
    {!! Form::label('has_asbuilt', __('models/workOrders.fields.has_asbuilt').':') !!}
    <p>{{ $returnSituation->has_asbuilt }}</p>
</div>

<!-- Asbuilt Number Field -->
<div class="col-sm-6">
    {!! Form::label('asbuilt_number', __('models/workOrders.fields.asbuilt_number').':') !!}
    <p>{{ $returnSituation->asbuilt_number }}</p>
</div>

<!-- Achievement Certificate Id Field -->
<div class="col-sm-6">
    {!! Form::label('achievement_certificate_id', __('models/workOrders.fields.achievement_certificate_id').':') !!}
    <p>{{ $returnSituation->achievement_certificate_id }}</p>
</div>

<hr class="invoice-spacing">

<!-- Payment Clearance Id Field -->
<div class="col-sm-6">
    {!! Form::label('payment_clearance_id', __('models/workOrders.fields.payment_clearance_id').':') !!}
    <p>{{ $returnSituation->payment_clearance_id }}</p>
</div>

<!-- Work Orders Type Id Field -->
<div class="col-sm-6">
    {!! Form::label('work_orders_type_id', __('models/workOrders.fields.work_orders_type_id').':') !!}
    <p>{{ $returnSituation->work_orders_type_id }}</p>
</div>




    <!-- work order status Field -->
    {{-- <div class="form-group col-sm-6">
        <x-select2 name="status" :options="$statusList"  :defaultValue='$workOrdersPermit->status' :labelTitle="__('models/workOrders.fields.status')"></x-select2>
    </div> --}}

    @include('return_situations.details.details')

@else
    <!-- Work Order Number Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('work_order_number', __('models/returnSituations.fields.work_order_number').':') !!}
        {!! Form::text('work_order_number', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Work Type Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('work_type_id', __('models/returnSituations.fields.work_type_id').':') !!}
        {!! Form::text('work_type_id', null, ['class' => 'form-control']) !!}
    </div>


@endif
