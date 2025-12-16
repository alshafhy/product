<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/contractors.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Company Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_name', __('models/contractors.fields.company_name').':') !!}
    {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_name', __('models/contractors.fields.contact_name').':') !!}
    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Mobile Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_mobile_number', __('models/contractors.fields.contact_mobile_number').':') !!}
    {!! Form::text('contact_mobile_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notes', __('models/contractors.fields.notes').':') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
</div>