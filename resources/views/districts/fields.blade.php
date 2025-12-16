<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/districts.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/districts.fields.city_name').':') !!}
    {!! Form::select('city_id', $cities,null, ['class' => 'select2 form-select form-control']) !!}
</div>
