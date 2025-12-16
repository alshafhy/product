<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/departments.fields.id').':') !!}
    <p>{{ $department->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/departments.fields.name').':') !!}
    <p>{{ $department->name }}</p>
</div>

<!-- Branch Id Field -->
<div class="col-sm-12">
    {!! Form::label('branch_id', __('models/departments.fields.branch_name').':') !!}
    <p>{{ $department->branch->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/departments.fields.description').':') !!}
    <p>{{ $department->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/departments.fields.created_at').':') !!}
    <p>{{ $department->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/departments.fields.updated_at').':') !!}
    <p>{{ $department->updated_at }}</p>
</div>

