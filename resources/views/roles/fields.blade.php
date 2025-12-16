<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/roles.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Ar Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ar_name', __('models/roles.fields.ar_name').':') !!}
    {!! Form::text('ar_name', null, ['class' => 'form-control']) !!}
</div>