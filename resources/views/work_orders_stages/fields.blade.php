<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/workOrdersStages.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Default Next Stage Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('default_next_stage_id', __('models/workOrdersStages.fields.default_next_stage_id').':') !!}
    {!! Form::text('default_next_stage_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', __('models/workOrdersStages.fields.parent_id').':') !!}
    {!! Form::text('parent_id', null, ['class' => 'form-control']) !!}
</div>