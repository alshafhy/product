<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/workOrderServices.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', __('models/workOrderServices.fields.name_ar').':') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/workOrderServices.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/workOrderServices.fields.price').':') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/workOrderServices.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Unit Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit_id', __('models/items.fields.unit_id').':') !!}
    {!! Form::select('unit_id', $units,null, ['class' => 'select2 form-select form-control']) !!}
</div>

<!-- Items Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('services_category_id', __('models/items.fields.items_category_id').':') !!}
    {!! Form::select('services_category_id', $categories,null, ['class' => 'select2 form-select form-control']) !!}
</div>
