<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/emergencyIssuesTypes.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/emergencyIssuesTypes.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>