<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/workOrdersTypes.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', __('models/workOrdersTypes.fields.parent_id').':') !!}
    {!! Form::text('parent_id', null, ['class' => 'form-control']) !!}
</div>