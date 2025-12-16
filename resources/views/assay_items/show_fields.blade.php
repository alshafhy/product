<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/assayItems.fields.id').':') !!}
    <p>{{ $assayItem->id }}</p>
</div>

<!-- Assay Form Id Field -->
<div class="col-sm-12">
    {!! Form::label('assay_form_id', __('models/assayItems.fields.assay_form_id').':') !!}
    <p>{{ $assayItem->assay_form_id }}</p>
</div>

<!-- Item Id Field -->
<div class="col-sm-12">
    {!! Form::label('item_id', __('models/assayItems.fields.item_id').':') !!}
    <p>{{ $assayItem->item_id }}</p>
</div>

<!-- Spend Field -->
<div class="col-sm-12">
    {!! Form::label('spend', __('models/assayItems.fields.spend').':') !!}
    <p>{{ $assayItem->spend }}</p>
</div>

<!-- Used Field -->
<div class="col-sm-12">
    {!! Form::label('used', __('models/assayItems.fields.used').':') !!}
    <p>{{ $assayItem->used }}</p>
</div>

<!-- Returned Field -->
<div class="col-sm-12">
    {!! Form::label('returned', __('models/assayItems.fields.returned').':') !!}
    <p>{{ $assayItem->returned }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/assayItems.fields.created_at').':') !!}
    <p>{{ $assayItem->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/assayItems.fields.updated_at').':') !!}
    <p>{{ $assayItem->updated_at }}</p>
</div>

