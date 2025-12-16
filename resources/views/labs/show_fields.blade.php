<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/labs.fields.id').':') !!}
    <p>{{ $lab->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/labs.fields.name').':') !!}
    <p>{{ $lab->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/labs.fields.created_at').':') !!}
    <p>{{ $lab->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/labs.fields.updated_at').':') !!}
    <p>{{ $lab->updated_at }}</p>
</div>

