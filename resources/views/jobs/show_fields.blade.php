<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/jobs.fields.id').':') !!}
    <p>{{ $job->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/jobs.fields.name').':') !!}
    <p>{{ $job->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/jobs.fields.description').':') !!}
    <p>{{ $job->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/jobs.fields.created_at').':') !!}
    <p>{{ $job->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/jobs.fields.updated_at').':') !!}
    <p>{{ $job->updated_at }}</p>
</div>

