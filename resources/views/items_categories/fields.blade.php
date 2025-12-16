<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/itemsCategories.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', __('models/itemsCategories.fields.name_ar').':') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', __('models/itemsCategories.fields.parent_id').':') !!}
    {!! Form::select('parent_id', $itemsCategories,null, ['class' => 'select2 form-select form-control']) !!}
</div>
