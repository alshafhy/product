<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/items.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/items.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', __('models/items.fields.name_ar').':') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/items.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Unit Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit_id', __('models/items.fields.unit_id').':') !!}
    {!! Form::select('unit_id', $units,null, ['class' => 'select2 form-select form-control']) !!}
</div>

<!-- Items Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('items_category_id', __('models/items.fields.items_category_id').':') !!}
    {!! Form::select('items_category_id', $categories,null, ['class' => 'select2 form-select form-control']) !!}
</div>
