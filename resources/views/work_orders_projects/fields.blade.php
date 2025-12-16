<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/workOrdersProjects.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
 <!-- Stages Count Field -->
 <div class="form-group col-sm-6">
    {!! Form::label('stages_count', __('models/workOrdersProjects.fields.stages_count').':') !!}
    {!! Form::text('stages_count', null, ['class' => 'form-control']) !!}
</div>
@if($formMode == 'edit')
<div class="form-group col-sm-6">
    {!! Form::label('closed_work_order_number', __('models/workOrdersProjects.fields.closed_work_order_number').':') !!}
    {!! Form::text('closed_work_order_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {{-- {!! Form::label('copy_from_work_order_id', __('models/workOrdersProjects.fields.copy_from_work_order_id').':') !!}
    {!! Form::text('copy_from_work_order_id', null, ['class' => 'form-control']) !!} --}}
    <x-select2 name="copy_from_work_order_id" :options="$workOrders" :labelTitle="__('models/workOrdersProjects.fields.copy_from_work_order_id')"></x-select2>
</div>
@endif

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/workOrdersProjects.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','rows'=>"3" ]) !!}
</div>
{{-- 
<!-- Start Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date', __('models/workOrdersProjects.fields.start_date').':') !!}
    {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- End Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_date', __('models/workOrdersProjects.fields.end_date').':') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/workOrdersProjects.fields.status').':') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

 --}}
