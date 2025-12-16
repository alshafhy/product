<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/cities.fields.id').':') !!}
    <p>{{ $city->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/cities.fields.name').':') !!}
    <p>{{ $city->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/cities.fields.created_at').':') !!}
    <p>{{ $city->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/cities.fields.updated_at').':') !!}
    <p>{{ $city->updated_at }}</p>
</div>

