<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/layers.fields.id').':') !!}
    <p>{{ $layer->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/layers.fields.name').':') !!}
    <p>{{ $layer->name }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('order', __('models/layers.fields.order').':') !!}
    <p>{{ $layer->order }}</p>
</div>

<!-- Is Final Field -->
<div class="col-sm-12">
    {!! Form::label('is_final', __('models/layers.fields.is_final').':') !!}
    <p>{{ $layer->is_final }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/layers.fields.created_at').':') !!}
    <p>{{ $layer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/layers.fields.updated_at').':') !!}
    <p>{{ $layer->updated_at }}</p>
</div>

