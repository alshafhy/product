<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/workOrdersTypes.fields.id').':') !!}
    <p>{{ $workOrdersType->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/workOrdersTypes.fields.name').':') !!}
    <p>{{ $workOrdersType->name }}</p>
</div>

<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', __('models/workOrdersTypes.fields.parent_id').':') !!}
    <p>{{ $workOrdersType->parent_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/workOrdersTypes.fields.created_at').':') !!}
    <p>{{ $workOrdersType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/workOrdersTypes.fields.updated_at').':') !!}
    <p>{{ $workOrdersType->updated_at }}</p>
</div>

