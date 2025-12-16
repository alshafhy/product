<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/financialDues.fields.id').':') !!}
    <p>{{ $financialDue->id }}</p>
</div>

<!-- Due No Field -->
<div class="col-sm-12">
    {!! Form::label('due_no', __('models/financialDues.fields.due_no').':') !!}
    <p>{{ $financialDue->due_no }}</p>
</div>

<!-- Due Date Field -->
<div class="col-sm-12">
    {!! Form::label('due_date', __('models/financialDues.fields.due_date').':') !!}
    <p>{{ $financialDue->due_date }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/financialDues.fields.status').':') !!}
    <p>{{ $financialDue->status }}</p>
</div>

<!-- Financial Due Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('financial_due_type_id', __('models/financialDues.fields.financial_due_type_id').':') !!}
    <p>{{ $financialDue->financial_due_type_id }}</p>
</div>

<!-- Electricity Department Id Field -->
<div class="col-sm-12">
    {!! Form::label('electricity_department_id', __('models/financialDues.fields.electricity_department_id').':') !!}
    <p>{{ $financialDue->electricity_department_id }}</p>
</div>

<!-- Total Amount Field -->
<div class="col-sm-12">
    {!! Form::label('total_amount', __('models/financialDues.fields.total_amount').':') !!}
    <p>{{ $financialDue->total_amount }}</p>
</div>

<!-- Total Fines Amount Field -->
<div class="col-sm-12">
    {!! Form::label('total_fines_amount', __('models/financialDues.fields.total_fines_amount').':') !!}
    <p>{{ $financialDue->total_fines_amount }}</p>
</div>

<!-- Total Net Amount Field -->
<div class="col-sm-12">
    {!! Form::label('total_net_amount', __('models/financialDues.fields.total_net_amount').':') !!}
    <p>{{ $financialDue->total_net_amount }}</p>
</div>

<!-- Notes Field -->
<div class="col-sm-12">
    {!! Form::label('notes', __('models/financialDues.fields.notes').':') !!}
    <p>{{ $financialDue->notes }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/financialDues.fields.created_at').':') !!}
    <p>{{ $financialDue->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/financialDues.fields.updated_at').':') !!}
    <p>{{ $financialDue->updated_at }}</p>
</div>

