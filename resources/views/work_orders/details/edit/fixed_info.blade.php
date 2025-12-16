@php
    $work_order_status = config("const.work_order_general_status");
@endphp
<div class="cardMaster rounded border col-sm-4 p-2 mb-1">
    <div class="d-flex justify-content-between flex-sm-row flex-column">
      <div class="card-information">
        <img
          class="mb-1 img-fluid"
          {{-- src="{{asset('images/icons/payments/mastercard.png')}}" --}}
          width="100px" height="100px"
          src="{{asset('images/icons/work-orders/work-orders-blue.png')}}"
          alt="Work Order"
        />
        <div class="d-flex align-items-center mb-50">
          <h6 class="mb-0"> {!! Form::label('work_order_number', __('models/workOrders.fields.work_order_number').':') !!}
            <a href="{{url("workOrdersManagement/workOrders",['id'=>$workOrder->id])}}">
            {{$workOrder->work_order_number ?? $workOrder->mission_number }}</h6> &nbsp;</a>
            @if(isset($work_order_status[$workOrder->status]))
                <span class="badge rounded-pill {{$work_order_status[$workOrder->status]['class']}}">{{$work_order_status[$workOrder->status]['title']}}</span>
            @else
                {{$workOrder->status}}
            @endif
        </div>
        <span class="card-number">{!! Form::label('work_type_id', __('models/workOrders.fields.work_type_name').':') !!}
            {{$workOrder->workType->full_name ?? 'مهمة'}}</span>
      </div>

      <div class="d-flex flex-column text-start text-lg-end">
        <div class="d-flex order-sm-0 order-1 mt-1 mt-sm-0">
          {{-- <button class="btn btn-outline-primary me-75" data-bs-toggle="modal" data-bs-target="#editCard" title="ارسال أمر العمل الى الادارة التابعة">
            ارسال أمر العمل الى الادارة التابعة 
          </button> --}}
          {{-- <button class="btn btn-outline-secondary">حذف</button> --}}
        </div>
        <span class="mt-2" data-bs-toggle="tooltip" title="{{$workOrder->received_date->toDateString() ?? ''}}"> تاريخ أمر العمل
            <p style="direction: ltr">{{$workOrder->received_date->toDateString() ?? ''}}</p></span>
      </div>
      
    </div>
</div>

{{-- <p>
    <div class="form-group col-sm-6">
        {!! Form::label('work_order_number', __('models/workOrders.fields.work_order_number').':') !!}
        {{$workOrder->work_order_number ?? ''}}
    </div>

    <!-- Work Type Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('work_type_id', __('models/workOrders.fields.work_type_name').':') !!}
        {{$workOrder->workType->full_name ?? ''}}
    </div>
</p> --}}
