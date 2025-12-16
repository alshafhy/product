<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/itemsCategories.fields.id').':') !!}
    <p>{{ $itemsCategory->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/itemsCategories.fields.name').':') !!}
    <p>{{ $itemsCategory->name }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/itemsCategories.fields.name_ar').':') !!}
    <p>{{ $itemsCategory->name_ar }}</p>
</div>

<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', __('models/itemsCategories.fields.parent_id').':') !!}
    <p>{{ $itemsCategory->category->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/itemsCategories.fields.created_at').':') !!}
    <p>{{ $itemsCategory->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/itemsCategories.fields.updated_at').':') !!}
    <p>{{ $itemsCategory->updated_at }}</p>
</div>

