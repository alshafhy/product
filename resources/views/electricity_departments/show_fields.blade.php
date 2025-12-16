<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/electricityDepartments.fields.id').':') !!}
    <p>{{ $electricityDepartment->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/electricityDepartments.fields.name').':') !!}
    <p>{{ $electricityDepartment->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/electricityDepartments.fields.description').':') !!}
    <p>{{ $electricityDepartment->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/electricityDepartments.fields.created_at').':') !!}
    <p>{{ $electricityDepartment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/electricityDepartments.fields.updated_at').':') !!}
    <p>{{ $electricityDepartment->updated_at }}</p>
</div>

