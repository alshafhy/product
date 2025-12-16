<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/electricalStationsTypes.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/electricalStationsTypes.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Electrical Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('electrical_type', __('models/electricalStationsTypes.fields.electrical_type').':') !!}
    {{-- {!! Form::text('electrical_type', null, ['class' => 'form-control']) !!} --}}
    {!! Form::select('electrical_type', $electricalTypes,null, ['class' => 'select form-select form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/electricalStationsTypes.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>