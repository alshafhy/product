<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/workOrdersPermitTypes.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/workOrdersPermitTypes.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>