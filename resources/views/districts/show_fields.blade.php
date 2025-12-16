<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/districts.fields.id').':') !!}
    <p>{{ $district->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/districts.fields.name').':') !!}
    <p>{{ $district->name }}</p>
</div>

<!-- City Id Field -->
<div class="col-sm-12">
    {!! Form::label('city_id', __('models/districts.fields.city_id').':') !!}
    <p>{{ $district->city_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/districts.fields.created_at').':') !!}
    <p>{{ $district->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/districts.fields.updated_at').':') !!}
    <p>{{ $district->updated_at }}</p>
</div>

