<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/electricalStationsTypes.fields.id').':') !!}
    <p>{{ $electricalStationsType->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/electricalStationsTypes.fields.name').':') !!}
    <p>{{ $electricalStationsType->name }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', __('models/electricalStationsTypes.fields.code').':') !!}
    <p>{{ $electricalStationsType->code }}</p>
</div>

<!-- Electrical Type Field -->
<div class="col-sm-12">
    {!! Form::label('electrical_type', __('models/electricalStationsTypes.fields.electrical_type').':') !!}
    <p>{{ \App\Http\Controllers\ElectricalStationsTypeController::electricalTypes[$electricalStationsType->electrical_type] }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/electricalStationsTypes.fields.description').':') !!}
    <p>{{ $electricalStationsType->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/electricalStationsTypes.fields.created_at').':') !!}
    <p>{{ $electricalStationsType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/electricalStationsTypes.fields.updated_at').':') !!}
    <p>{{ $electricalStationsType->updated_at }}</p>
</div>

