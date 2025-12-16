<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/missionTypes.fields.id').':') !!}
    <p>{{ $missionType->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/missionTypes.fields.name').':') !!}
    <p>{{ $missionType->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/missionTypes.fields.created_at').':') !!}
    <p>{{ $missionType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/missionTypes.fields.updated_at').':') !!}
    <p>{{ $missionType->updated_at }}</p>
</div>

