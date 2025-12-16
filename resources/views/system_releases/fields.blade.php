<!-- Version Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('version_number', __('models/systemReleases.fields.version_number').':') !!}
    {!! Form::text('version_number', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Release Date Field -->
<div class="form-group col-sm-4">
    <x-date-pickr name="release_date" :labelTitle="__('models/systemReleases.fields.release_date')"></x-date-pickr>
    
</div>