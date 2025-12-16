<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/consultants.fields.id').':') !!}
    <p>{{ $consultant->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/consultants.fields.name').':') !!}
    <p>{{ $consultant->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/consultants.fields.created_at').':') !!}
    <p>{{ $consultant->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/consultants.fields.updated_at').':') !!}
    <p>{{ $consultant->updated_at }}</p>
</div>

