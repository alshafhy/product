<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.id') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->id }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.permit_number') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->permit_number }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.work_orders_permit_type_id') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->workOrdersPermitType->name }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.sadad_number') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->sadad_number }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.issued_amount') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->issued_amount }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.period') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->period }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.period') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            <div class="d-flex flex-column">

                <div class="progress w-100 me-3" style="height: 6px;">
                    <div class="progress-bar badge-light-primary" data-bs-toggle="tooltip" title="{{$workOrdersPermit->total_permit_period_percentage}}%" style="width: {{$workOrdersPermit->total_permit_period_percentage}}%" aria-valuenow="{{$workOrdersPermit->total_permit_period_percentage}}%" aria-valuemin="0" aria-valuemax="100">
                        <small class="mb-1">{{$workOrdersPermit->total_permit_period_percentage}}%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.issue_date') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->issue_date }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.start_date') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ Helper::dateFormat($workOrdersPermit->start_date) }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.end_date') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ Helper::dateFormat($workOrdersPermit->end_date) }}
        </div>
    </div>
</div>
@php $work_order_permit_status= config("const.work_order_permit_status"); @endphp
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.status') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            <span class="badge rounded-pill {{$work_order_permit_status[$workOrdersPermit->status]['class']}}">{{$work_order_permit_status[$workOrdersPermit->status]['title']}}</span>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.created_at') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->created_at }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.updated_at') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->updated_at }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrderFollows.fields.completion_certificate_status') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{Helper::getConfigOptionsList('const.completion_certificate_status')[$workOrdersPermit->completion_certificate_status]}}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrderFollows.fields.completion_certificate_date') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->completion_certificate_date }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrderFollows.fields.clearance_certificate_status') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ Helper::getConfigOptionsList('const.clearance_certificate_status')[$workOrdersPermit->clearance_certificate_status] }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrderFollows.fields.clearance_certificate_date') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->clearance_certificate_date }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrderFollows.fields.clearance_sdad_number') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->clearance_sdad_number }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrderFollows.fields.clearance_sdad_date') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->clearance_sdad_date }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4  d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.clearance_sdad_amount') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->clearance_sdad_amount }}
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="mb-1 row">
        <div class="col-sm-4 d-flex">
            <span class=" text-primary">{{  __('models/workOrdersPermits.fields.notes') }}</span>
            &nbsp;
            <b>:</b>
        </div>
        <div class="col-sm-8 ">
            {{ $workOrdersPermit->notes }}
        </div>
    </div>
</div>