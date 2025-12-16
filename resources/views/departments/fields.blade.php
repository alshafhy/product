<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/departments.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Branch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', __('models/departments.fields.branch_id').':') !!}
    {!! Form::select('branch_id', $branches,null, ['class' => 'select2 form-select form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', __('models/departments.fields.description').':') !!}
    {!! Form::textArea('description', null, ['class' => 'form-control' ,'rows'=>"3" ]) !!}
</div>