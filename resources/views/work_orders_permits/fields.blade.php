
@if($formMode == 'edit')
    @php
    $workOrder = $workOrdersPermit->workOrders->first();
    @endphp
    <div class="form-group col-sm-12 col-lg-12">
        @include('work_orders.details.edit.fixed_info' ,["workOrder"=>$workOrder])
        {{ Form::hidden('work_order_id', $workOrder->id , ['id' => 'work_order_id']) }}
    </div>
@endif

@if($formMode != 'edit')
<!-- work order id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_mission', __('models/workOrdersPermits.fields.is_mission').':') !!}
    {!! Form::select('is_mission', ['0'=>'أوامر عمل إنشاءات', '1'=>'مهمات طوارئ'] ,null, ['class' => 'select2 form-select form-control']) !!}
</div>
<div class="form-group col-sm-6" id="work_order_id_dev">
    <x-select2 name="work_order_id" :options="$workOrders" :labelTitle="__('models/workOrdersPermits.fields.work_order_id')"></x-select2>
</div>
<div class="form-group col-sm-6" id="mission_id_dev">
    <x-select2 name="mission_id" :options="$missions" :labelTitle="__('models/workOrdersPermits.fields.mission_id')"></x-select2>
</div>
@endif

<!-- Permit Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permit_number', __('models/workOrdersPermits.fields.permit_number').':') !!}
    {!! Form::text('permit_number', null, ['class' => 'form-control']) !!}
</div>
<!-- Sadad Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sadad_number', __('models/workOrdersPermits.fields.sadad_number').':') !!}
    {!! Form::text('sadad_number', null, ['class' => 'form-control']) !!}
</div>
<!-- Work Orders Permit Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('work_orders_permit_type_id', __('models/workOrdersPermits.fields.work_orders_permit_type_id').':') !!}
    @if($formMode != 'edit')
    {!! Form::select('work_orders_permit_type_id', $workOrdersPermitTypes ,null, ['class' => 'select2 form-select form-control']) !!}
    @else
    <input type="text" readonly value="{{$workOrdersPermit->workOrdersPermitType->name}}" class="form-control">
    {{ Form::hidden('work_orders_permit_type_id', $workOrdersPermit->work_orders_permit_type_id , ['id' => 'work_orders_permit_type_id']) }}
    @endif
</div><!-- Work Orders Permit Type Id Field -->

<div class="form-group col-sm-6">
    {{-- {!! Form::label('balady_id', __('models/workOrdersPermits.fields.balady_id').':') !!} --}}
    {{-- {!! Form::select('balady_id', $baladys ,null, ['class' => 'select2 form-select form-control']) !!} --}}
    <x-select2 name="balady_id" :options="$baladys" :labelTitle="__('models/workOrdersPermits.fields.balady_id')"></x-select2>
</div><!-- balady Id Field -->

<div class="form-group col-sm-6">
    {!! Form::label('street', __('models/workOrdersPermits.fields.street').':') !!}
    {!! Form::text('street' ,null, ['class' => 'form-control']) !!}
</div><!-- district Id Field -->




<!-- Issue Date Field -->
<div class="form-group col-sm-6">
    <x-date-pickr name="issue_date" :labelTitle="__('models/workOrdersPermits.fields.issue_date')"></x-date-pickr>
</div>

<!-- Issue Date Field -->
<div class="form-group col-sm-6">
    <x-date-pickr name="end_date" :labelTitle="__('models/workOrdersPermits.fields.end_date')"></x-date-pickr>
</div>

<!-- Issued Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('issued_amount', __('models/workOrdersPermits.fields.issued_amount').':') !!}
    {!! Form::text('issued_amount', null, ['class' => 'form-control']) !!}
</div>




<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-6">
    {!! Form::label('notes', __('models/workOrdersPermits.fields.notes').':') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control w-75' , 'cols'=>'10' , 'rows'=>'5']) !!}
</div>

@if($formMode == 'edit')
    @if($workOrdersPermit->work_orders_permit_type_id == 1)
    <div class="row">
        <fieldset class="border p-1 ">
            <legend  class="float-none w-auto">معلومات الطول</legend>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>تراب</label>
                    <div class="input-group">
                        <input type="number" id="length_dust" name="length_dust" class="touchspinC" onchange="calcTotal()" value="{{$workOrdersPermit->length_dust ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label>أسفلت</label>
                    <div class="input-group">
                        <input type="number" id="length_asphalt" name="length_asphalt" class="touchspinC" onchange="calcTotal()" value="{{$workOrdersPermit->length_asphalt ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label>رصيف</label>
                    <div class="input-group">
                        <input type="number" id="length_sidewalk" name="length_sidewalk" class="touchspinC" onchange="calcTotal()"value="{{$workOrdersPermit->length_sidewalk ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label>إجمالي</label>
                    <div class="input-group">
                        <input type="number" id="length_total" name="length_total" class="touchspinC" onchange="calcTotal()" value="{{$workOrdersPermit->length_total ?? 0 }}" />
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label>عدد الطبقات المطلوبة</label>
            <div class="input-group">
                <input type="number" name="drilling_layer" class="touchspinC" value="{{$workOrdersPermit->drilling_layer ?? 0 }}" />
            </div>
        </div>
        <div class="form-group col-sm-3">
            <label>عمق الحفرية</label>
            <div class="input-group">
                <input type="number" name="drilling_deep" class="touchspinC" value="{{$workOrdersPermit->drilling_deep ?? 0 }}" />
            </div>
        </div>
        <div class="form-group col-sm-3">
            <label>عرض الحفرية</label>
            <div class="input-group">
                <input type="number" name="drilling_width" class="touchspinC" value="{{$workOrdersPermit->drilling_width ?? 0 }}" />
            </div>
        </div>
        <div class="form-group col-sm-3">
            <label class="form-label" for="drilling_type">نوع الحفر</label>
            <select class="select2 form-select" name="drilling_type" id="drilling_type">
                <option value="">اختار</option>
                <option value="مفتوح" @if(isset($workOrdersPermit->drilling_type) && $workOrdersPermit->drilling_type == 'مفتوح') selected @endif>مفتوح</option>
                <option value="Microtrench" @if(isset($workOrdersPermit->drilling_type) && $workOrdersPermit->drilling_type == 'Microtrench') selected @endif>Microtrench</option>
            </select>
        </div>
    </div>
    @endif
    <!-- work order status Field -->
    <div class="form-group col-sm-6">
        <x-select2 name="status" :options="$statusList"  :defaultValue='$workOrdersPermit->status' :labelTitle="__('models/workOrders.fields.status')"></x-select2>
    </div>

    <!-- Notes Field -->
    <div id="refuse_reason_div" class="form-group col-sm-12 col-lg-12" style="display: none">
        {!! Form::label('refuse_reason', __('models/workOrdersPermits.fields.refuse_reason').':') !!}
        {!! Form::textarea('refuse_reason', null, ['class' => 'form-control' , 'cols'=>'10' , 'rows'=>'5']) !!}
    </div>
    <div class="col-sm-12 col-lg-12">
    @include('work_orders_permits.details.details')
    </div>
@endif


@push('page-script')
<script>
    var issue_date = $("#issue_date").flatpickr({
            // maxDate: "{{date('Y-m-d')}}",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                end_date.set('minDate', dateStr)
            }
        });

    var end_date = $("#end_date").flatpickr({
        dateFormat: "Y-m-d"
    });

    $("#length_total").prop("readonly", true);

    function calcTotal() {
        const total =  parseFloat($("#length_dust").val()) + parseFloat($("#length_asphalt").val()) + parseFloat($("#length_sidewalk").val());
        $("#length_total").val(total);
    }

    $("#mission_id_dev").hide();

    $("#is_mission").on("change",function(){
        //is_mission
        if($(this).val() == 1){
            $("#mission_id_dev").show();
            $("#work_order_id_dev").hide();
        }else{
            $("#mission_id_dev").hide();
            $("#work_order_id_dev").show();
        }
    });
    //$("#is_mission").toggle("change");
    if($("#is_mission").val() == 1){
        $("#mission_id_dev").show();
        $("#work_order_id_dev").hide();
    }else{
        $("#mission_id_dev").hide();
        $("#work_order_id_dev").show();
    }
    $(".touchspinC").TouchSpin({
                min: 0,
                max: 9999,
                step: 1,
                decimals: 2,
                forcestepdivisibility: 'none',
                // boostat: 5,
                // maxboostedstep: 10,
                // postfix: '%'
            });
</script>
@endpush
