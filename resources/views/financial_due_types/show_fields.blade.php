<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/financialDueTypes.fields.id').':') !!}
    <p>{{ $financialDueType->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/financialDueTypes.fields.name').':') !!}
    <p>{{ $financialDueType->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/financialDueTypes.fields.created_at').':') !!}
    <p>{{ $financialDueType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/financialDueTypes.fields.updated_at').':') !!}
    <p>{{ $financialDueType->updated_at }}</p>
</div>

