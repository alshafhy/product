<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/branches.fields.id').':') !!}
    <p>{{ $branch->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/branches.fields.name').':') !!}
    <p>{{ $branch->name }}</p>
</div>

<!-- City Id Field -->
<div class="col-sm-12">
    {!! Form::label('city_id', __('models/branches.fields.city_id').':') !!}
    <p>{{ $branch->city->name ?? "" }}</p>
</div>

<!-- District Id Field -->
<div class="col-sm-12">
    {!! Form::label('district_id', __('models/branches.fields.district_id').':') !!}
    <p>{{ $branch->district->name ?? "" }}</p>
</div>

<!-- Is Main Branch Field -->
<div class="col-sm-12">
    {!! Form::label('is_main_branch', __('models/branches.fields.is_main_branch').':') !!}
    <p>{{ ($branch->is_main_branch) ? __("yes"):__("no")  }}</p>
</div>

