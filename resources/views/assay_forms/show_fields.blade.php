<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/assayForms.fields.id').':') !!}
    <p>{{ $assayForm->id }}</p>
</div>

<!-- Work Order Id Field -->
<div class="col-sm-12">
    {!! Form::label('work_order_id', __('models/assayForms.fields.work_order_id').':') !!}
    <p>{{ $assayForm->work_order_id }}</p>
</div>

<!-- District Id Field -->
<div class="col-sm-12">
    {!! Form::label('district_id', __('models/assayForms.fields.district_id').':') !!}
    <p>{{ $assayForm->district_id }}</p>
</div>

<!-- Work Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('work_type_id', __('models/assayForms.fields.work_type_id').':') !!}
    <p>{{ $assayForm->work_type_id }}</p>
</div>

<!-- Customer Name Field -->
<div class="col-sm-12">
    {!! Form::label('customer_name', __('models/assayForms.fields.customer_name').':') !!}
    <p>{{ $assayForm->customer_name }}</p>
</div>

<!-- Notes Field -->
<div class="col-sm-12">
    {!! Form::label('notes', __('models/assayForms.fields.notes').':') !!}
    <p>{{ $assayForm->notes }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/assayForms.fields.status').':') !!}
    <p>{{ $assayForm->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/assayForms.fields.created_at').':') !!}
    <p>{{ $assayForm->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/assayForms.fields.updated_at').':') !!}
    <p>{{ $assayForm->updated_at }}</p>
</div>

