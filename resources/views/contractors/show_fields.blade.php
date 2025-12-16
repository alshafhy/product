<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/contractors.fields.id').':') !!}
    <p>{{ $contractor->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/contractors.fields.name').':') !!}
    <p>{{ $contractor->name }}</p>
</div>

<!-- Company Name Field -->
<div class="col-sm-12">
    {!! Form::label('company_name', __('models/contractors.fields.company_name').':') !!}
    <p>{{ $contractor->company_name }}</p>
</div>

<!-- Contact Name Field -->
<div class="col-sm-12">
    {!! Form::label('contact_name', __('models/contractors.fields.contact_name').':') !!}
    <p>{{ $contractor->contact_name }}</p>
</div>

<!-- Contact Mobile Number Field -->
<div class="col-sm-12">
    {!! Form::label('contact_mobile_number', __('models/contractors.fields.contact_mobile_number').':') !!}
    <p>{{ $contractor->contact_mobile_number }}</p>
</div>

<!-- Notes Field -->
<div class="col-sm-12">
    {!! Form::label('notes', __('models/contractors.fields.notes').':') !!}
    <p>{{ $contractor->notes }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/contractors.fields.created_at').':') !!}
    <p>{{ $contractor->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/contractors.fields.updated_at').':') !!}
    <p>{{ $contractor->updated_at }}</p>
</div>

