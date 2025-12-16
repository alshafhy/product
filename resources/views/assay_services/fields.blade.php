<!-- Assay Form Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assay_form_id', __('models/assayServices.fields.assay_form_id').':') !!}
    {!! Form::select('assay_form_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', __('models/assayServices.fields.service_id').':') !!}
    {!! Form::select('service_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', __('models/assayServices.fields.quantity').':') !!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
</div>