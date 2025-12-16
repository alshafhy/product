<!-- Due No Field -->
<div class="form-group col-sm-4">
    {!! Form::label('due_no', __('models/financialDues.fields.due_no').':') !!}
    {!! Form::text('due_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Financial Due Type Id Field -->
<div class="form-group col-sm-4">
    <x-select2 name="financial_due_type_id" :options="$financialDueTypes" :labelTitle="__('models/financialDues.fields.financial_due_type_id')"></x-select2> 
</div>






<!-- Electricity Department Id Field -->
<div class="form-group col-sm-4">
    <x-select2 name="electricity_department_id" :options="$electricityDepartments" :labelTitle="__('models/financialDues.fields.electricity_department_id')"></x-select2> 
</div>
<div class="form-group col-sm-4">
    <x-date-pickr name="due_date" :labelTitle="__('models/financialDues.fields.due_date')"></x-date-pickr>
</div>


<!-- Notes Field -->
<div class="form-group col-sm-8 col-lg-8">
    {!! Form::label('notes', __('models/financialDues.fields.notes').':') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control' ,'rows'=>2]) !!}
</div>
<div class="form-group col-sm-3  rounded p-1">
    <span class="bold">اجمالى المستخلص</span>:
    <span id="total_service_price">{{(isset($financialDue)) ? number_format($financialDue->total_final_amount,2): 0}}</span>
</div>
