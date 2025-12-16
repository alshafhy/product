<!-- Assay Form Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assay_form_id', __('models/assayItems.fields.assay_form_id').':') !!}
    {!! Form::text('assay_form_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_id', __('models/assayItems.fields.item_id').':') !!}
    {!! Form::text('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Spend Field -->
<div class="form-group col-sm-6">
    {!! Form::label('spend', __('models/assayItems.fields.spend').':') !!}
    {!! Form::text('spend', null, ['class' => 'form-control']) !!}
</div>

<!-- Used Field -->
<div class="form-group col-sm-6">
    {!! Form::label('used', __('models/assayItems.fields.used').':') !!}
    {!! Form::text('used', null, ['class' => 'form-control']) !!}
</div>

<!-- Returned Field -->
<div class="form-group col-sm-6">
    {!! Form::label('returned', __('models/assayItems.fields.returned').':') !!}
    {!! Form::text('returned', null, ['class' => 'form-control']) !!}
</div>