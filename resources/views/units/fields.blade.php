<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/units.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/units.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', __('models/units.fields.name_ar').':') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/units.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>