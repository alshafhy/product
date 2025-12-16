<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/workOrdersStages.fields.id').':') !!}
    <p>{{ $workOrdersStage->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/workOrdersStages.fields.name').':') !!}
    <p>{{ $workOrdersStage->name }}</p>
</div>

<!-- Default Next Stage Id Field -->
<div class="col-sm-12">
    {!! Form::label('default_next_stage_id', __('models/workOrdersStages.fields.default_next_stage_id').':') !!}
    <p>{{ $workOrdersStage->default_next_stage_id }}</p>
</div>

<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', __('models/workOrdersStages.fields.parent_id').':') !!}
    <p>{{ $workOrdersStage->parent_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/workOrdersStages.fields.created_at').':') !!}
    <p>{{ $workOrdersStage->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/workOrdersStages.fields.updated_at').':') !!}
    <p>{{ $workOrdersStage->updated_at }}</p>
</div>

