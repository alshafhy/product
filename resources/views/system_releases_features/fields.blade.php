<!-- System Release Id Field -->
<div class="form-group col-sm-6">
    {{-- {!! Form::label('system_release_id', __('models/systemReleasesFeatures.fields.system_release_id').':') !!}
    {!! Form::text('system_release_id', null, ['class' => 'form-control', 'required']) !!} --}}
    <x-select2 name="system_release_id" :options="$systemReleases" :labelTitle="__('models/systemReleasesFeatures.fields.system_release_id')"></x-select2>

</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/systemReleasesFeatures.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/systemReleasesFeatures.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Feature Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('feature_order', __('models/systemReleasesFeatures.fields.feature_order').':') !!}
    {!! Form::text('feature_order', null, ['class' => 'form-control']) !!}
</div>