<style>
    label{
        font-weight: bold;
    }
</style>

<!-- Id Field -->
{{-- <div class="col-sm-6">
    {!! Form::label('id', __('models/workOrdersPermits.fields.id').':') !!}
    <p>{{ $workOrderFollow->id }}</p>
</div> --}}

@php
    $work_order_status = config("const.work_order_general_status");
    $work_order_permit_status = config("const.work_order_permit_status");
@endphp
@foreach ( $workOrderFollow->workOrders as $workOrder )

<div class="cardMaster rounded border col-sm-4 p-2 mb-1">
    <div class="d-flex justify-content-between flex-sm-row flex-column">
      <div class="card-information">
        @if($workOrder->drilling_status !=2)
          <div class="alert alert-danger" role="alert">برجاء العلم ان أمر العمل لم يتم انتهاء أعمال الحفر به     </div>
        @endif
        <h4 class="invoice-title">
            {!! Form::label('permit_number', __('models/workOrdersPermits.fields.permit_number').':') !!}
            <a href="{{url("workOrdersManagement/workOrdersPermits",['id'=>$workOrderFollow->id])}}" class="invoice-number">{{$workOrderFollow->permit_number ?? ''}}</a>&nbsp;
            @if(isset($work_order_permit_status[$workOrderFollow->status]))
                  <span class="badge rounded-pill {{$work_order_permit_status[$workOrderFollow->status]['class']}}">{{$work_order_permit_status[$workOrderFollow->status]['title']}}</span>
            @else
                {{$workOrderFollow->status}}
            @endif
        </h4>
        <img
          class="mb-1 img-fluid"
          {{-- src="{{asset('images/icons/payments/mastercard.png')}}" --}}
          width="100px" height="100px"
          src="{{asset('images/icons/work-orders/work-orders-blue.png')}}"
          alt="Work Order"
        />
        {{-- <span class="mt-2" data-bs-toggle="tooltip" title="{{$workOrderFollow->start_date ?? ''}}"> تاريخ بداية التصريح {{$workOrderFollow->start_date ?? ''}}</span>
        <span class="mt-1" data-bs-toggle="tooltip" title="{{$workOrderFollow->end_date ?? ''}}"> تاريخ نهاية التصريح {{$workOrderFollow->end_date ?? ''}}</span> --}}

        <span class="card-number">{!! Form::label('work_type_id', __('models/workOrdersPermits.fields.from').':') !!}
            {{$workOrderFollow->start_date ?? ''}}
        </span>
        <span class="card-number">{!! Form::label('work_type_id', __('models/workOrdersPermits.fields.to').':',['class'=>"font-weight-bold"]) !!}
            {{$workOrderFollow->end_date ?? ''}}
        </span><br>

        <span class="card-number">{!! Form::label('work_type_id', __('models/workOrdersPermits.fields.issued_amount').':') !!}
            {{$workOrderFollow->issued_amount ?? ''}}</span><br>
        <div class="d-flex align-items-center mb-50">
            <h6 class="mb-0"> {!! Form::label('work_period', __('models/workOrdersPermits.fields.period').':') !!}
                {{$workOrderFollow->work_period ?? ''}}</h6> &nbsp; {{__("day")}}
        </div>
        <br>
        <div class="d-flex align-items-center mb-50">
          <h6 class="mb-0"> {!! Form::label('work_order_number', __('models/workOrders.fields.work_order_number').':') !!}
            <a href="{{url("workOrdersManagement/workOrders",['id'=>$workOrder->id])}}">
            {{$workOrder->work_order_number ?? ''}}</h6> &nbsp;</a>
            @if(isset($work_order_status[$workOrder->status]))
                <span class="badge rounded-pill {{$work_order_status[$workOrder->status]['class']}}">{{$work_order_status[$workOrder->status]['title']}}</span>
            @else
                {{$workOrder->status}}
            @endif
        </div>
        <div class="d-flex align-items-center mb-50">
            <h6 class="mb-0"> {!! Form::label('work_order_number', __('models/workOrders.fields.work_order_date').':') !!}
                {{$workOrder->received_date->toDateString() ?? ''}}</h6> &nbsp;
        </div>
        <div class="d-flex align-items-center mb-50">
            <h6 class="mb-0"> {!! Form::label('work_order_number', __('models/workOrders.fields.work_period').':') !!}
                {{$workOrder->work_period ?? ''}}</h6> &nbsp; {{__("day")}}
        </div>
        <!-- District Id Field -->
        <div class="col-sm-6">
            {{-- {!! Form::label('district_id', __('models/workOrders.fields.district_id').':') !!} --}}
            <span class="card-number">{!! Form::label('district_id', __('models/workOrders.fields.district_name').':') !!}
                {{$workOrder->district->name ?? ''}}</span>
        </div>
      </div>
       <!-- Work Period Field -->
      {{-- <div class="d-flex flex-column text-start text-lg-end">
        <div class="d-flex order-sm-0 order-1 mt-1 mt-sm-0">

        </div>
        <span class="mt-1" data-bs-toggle="tooltip" title="{{$workOrder->received_date ?? ''}}"> تاريخ أمر العمل <br>{{$workOrder->received_date->toDateString() ?? ''}}</span>
        <div >
            {!! Form::label('work_period', __('models/workOrders.fields.work_period').':') !!}
            <p>{{ $workOrder->work_period }}</p>
        </div>        <div >
            {!! Form::label('work_period', __('models/workOrdersPermits.fields.period').':') !!}
            <p>{{ $workOrderFollow->work_period }}</p>
        </div>
      </div> --}}
    </div>
</div>

@endforeach

<div class="row col-sm-8 ">

    {{-- <div class="form-group col-sm-6">
        {!! Form::label('reference_number', __('models/workOrders.fields.reference_number').':') !!}
        {!! Form::text('reference_number', null, ['class' => 'form-control']) !!}
    </div> --}}

    <!-- completion_certificate_status Field -->
    <div class="form-group col-sm-4">
        <x-select2 name="completion_certificate_status" :options="Helper::getConfigOptionsList('const.completion_certificate_status')" :labelTitle="__('models/workOrderFollows.fields.completion_certificate_status')"></x-select2>
    </div>
    <!-- completion_certificate_date Field -->
    <div class="form-group col-sm-6">
        <x-date-pickr name="completion_certificate_date" :labelTitle="__('models/workOrderFollows.fields.completion_certificate_date')"></x-date-pickr>
    </div>
    <!-- clearance_certificate_status Field -->
    <div class="form-group col-sm-4">
        <x-select2 name="clearance_certificate_status" :options="Helper::getConfigOptionsList('const.clearance_certificate_status')" :labelTitle="__('models/workOrderFollows.fields.clearance_certificate_status')"></x-select2>
    </div>
    <!-- clearance_certificate_date Field -->
    <div class="form-group col-sm-6">
        <x-date-pickr name="clearance_certificate_date" :labelTitle="__('models/workOrderFollows.fields.clearance_certificate_date')"></x-date-pickr>
    </div>

    <!-- clearance_sdad_number Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('clearance_sdad_number', __('models/workOrderFollows.fields.clearance_sdad_number').':') !!}
        {!! Form::text('clearance_sdad_number', null, ['class' => 'form-control']) !!}
    </div>
    <!-- clearance_sdad_date Field -->
    <div class="form-group col-sm-4">
        <x-date-pickr name="clearance_sdad_date" :labelTitle="__('models/workOrderFollows.fields.clearance_sdad_date')"></x-date-pickr>
    </div>
    <!-- clearance_sdad_amount Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('clearance_sdad_amount', __('models/workOrdersPermits.fields.clearance_sdad_amount').':') !!}
        {!! Form::number('clearance_sdad_amount', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Notes Field -->
    <div class="form-group col-sm-6 col-lg-12">
        {!! Form::label('notes', __('models/workOrdersPermits.fields.notes').':') !!}
        {!! Form::textarea('notes', null, ['class' => 'form-control w-75' , 'cols'=>'10' , 'rows'=>'5']) !!}
    </div>

</div>





@if($formMode == 'edit')
    <!-- work order status Field -->
    {{-- <div class="form-group col-sm-6">
        <x-select2 name="status" :options="$statusList"  :defaultValue='$workOrdersPermit->status' :labelTitle="__('models/workOrders.fields.status')"></x-select2>
    </div> --}}

    @include('work_orders_follows.details.details')
@endif
