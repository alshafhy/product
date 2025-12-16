<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/colors.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>