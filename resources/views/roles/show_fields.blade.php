<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/roles.fields.id').':') !!}
    <p>{{ $role->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/roles.fields.name').':') !!}
    <p>{{ $role->name }}</p>
</div>

<!-- Ar Name Field -->
<div class="col-sm-12">
    {!! Form::label('ar_name', __('models/roles.fields.ar_name').':') !!}
    <p>{{ $role->ar_name }}</p>
</div>

