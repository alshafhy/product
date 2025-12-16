<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/attachmentTypes.fields.id').':') !!}
    <p>{{ $attachmentType->id }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', __('models/attachmentTypes.fields.title').':') !!}
    <p>{{ $attachmentType->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/attachmentTypes.fields.description').':') !!}
    <p>{{ $attachmentType->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/attachmentTypes.fields.created_at').':') !!}
    <p>{{ $attachmentType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/attachmentTypes.fields.updated_at').':') !!}
    <p>{{ $attachmentType->updated_at }}</p>
</div>

