<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/assayServices.fields.id').':') !!}
    <p>{{ $assayService->id }}</p>
</div>

<!-- Assay Form Id Field -->
<div class="col-sm-12">
    {!! Form::label('assay_form_id', __('models/assayServices.fields.assay_form_id').':') !!}
    <p>{{ $assayService->assay_form_id }}</p>
</div>

<!-- Service Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_id', __('models/assayServices.fields.service_id').':') !!}
    <p>{{ $assayService->service_id }}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', __('models/assayServices.fields.quantity').':') !!}
    <p>{{ $assayService->quantity }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/assayServices.fields.created_at').':') !!}
    <p>{{ $assayService->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/assayServices.fields.updated_at').':') !!}
    <p>{{ $assayService->updated_at }}</p>
</div>

