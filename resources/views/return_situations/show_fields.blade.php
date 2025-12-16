<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/returnSituations.fields.id').':') !!}
    <p>{{ $returnSituation->id }}</p>
</div>

<!-- Work Order Number Field -->
<div class="col-sm-12">
    {!! Form::label('work_order_number', __('models/returnSituations.fields.work_order_number').':') !!}
    <p>{{ $returnSituation->work_order_number }}</p>
</div>

<!-- Work Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('work_type_id', __('models/returnSituations.fields.work_type_id').':') !!}
    <p>{{ $returnSituation->work_type_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/returnSituations.fields.created_at').':') !!}
    <p>{{ $returnSituation->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/returnSituations.fields.updated_at').':') !!}
    <p>{{ $returnSituation->updated_at }}</p>
</div>

