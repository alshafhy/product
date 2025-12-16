<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/units.fields.id').':') !!}
    <p>{{ $unit->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/units.fields.name').':') !!}
    <p>{{ $unit->name }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', __('models/units.fields.code').':') !!}
    <p>{{ $unit->code }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/units.fields.name_ar').':') !!}
    <p>{{ $unit->name_ar }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/units.fields.description').':') !!}
    <p>{{ $unit->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/units.fields.created_at').':') !!}
    <p>{{ $unit->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/units.fields.updated_at').':') !!}
    <p>{{ $unit->updated_at }}</p>
</div>

