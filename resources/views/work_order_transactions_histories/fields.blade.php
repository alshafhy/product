<!-- Work Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('work_order_id', __('models/workOrderTransactionsHistories.fields.work_order_id').':') !!}
    {!! Form::text('work_order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/workOrderTransactionsHistories.fields.user_id').':') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Work Order Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('work_order_number', __('models/workOrderTransactionsHistories.fields.work_order_number').':') !!}
    {!! Form::text('work_order_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Old Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('old_status', __('models/workOrderTransactionsHistories.fields.old_status').':') !!}
    {!! Form::text('old_status', null, ['class' => 'form-control']) !!}
</div>

<!-- New Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('new_status', __('models/workOrderTransactionsHistories.fields.new_status').':') !!}
    {!! Form::text('new_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Old Department Field -->
<div class="form-group col-sm-6">
    {!! Form::label('old_department', __('models/workOrderTransactionsHistories.fields.old_department').':') !!}
    {!! Form::text('old_department', null, ['class' => 'form-control']) !!}
</div>

<!-- New Department Field -->
<div class="form-group col-sm-6">
    {!! Form::label('new_department', __('models/workOrderTransactionsHistories.fields.new_department').':') !!}
    {!! Form::text('new_department', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', __('models/workOrderTransactionsHistories.fields.type').':') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/workOrderTransactionsHistories.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Note Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('note', __('models/workOrderTransactionsHistories.fields.note').':') !!}
    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
</div>