<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/items.fields.id').':') !!}
    <p>{{ $item->id }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', __('models/items.fields.code').':') !!}
    <p>{{ $item->code }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/items.fields.name').':') !!}
    <p>{{ $item->name }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/items.fields.name_ar').':') !!}
    <p>{{ $item->name_ar }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/items.fields.description').':') !!}
    <p>{{ $item->description }}</p>
</div>

<!-- Unit Id Field -->
<div class="col-sm-12">
    {!! Form::label('unit_id', __('models/items.fields.unit_id').':') !!}
    <p>{{ $item->unit->name }}</p>
</div>

<!-- Items Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('items_category_id', __('models/items.fields.items_category_id').':') !!}
    <p>{{ $item->category->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/items.fields.created_at').':') !!}
    <p>{{ $item->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/items.fields.updated_at').':') !!}
    <p>{{ $item->updated_at }}</p>
</div>

