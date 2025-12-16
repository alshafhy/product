<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{  __('models/workOrderServices.fields.id').' :' }}
        </div>
        <div class="col-sm-9">
            # {{ $workOrderService->id }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.name').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->name }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{  __('models/workOrderServices.fields.name_ar').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->name_ar }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.code').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->code }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{  __('models/workOrderServices.fields.price').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->price }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.description').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->description }}
        </div>
    </div>
</div>


<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{  __('models/workOrderServices.fields.unit_id').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->unit->name ?? '' }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.services_category_id').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->servicesCategory->name ?? '' }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{  __('models/workOrderServices.fields.created_at').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->created_at }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.updated_at').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $workOrderService->updated_at }}
        </div>
    </div>
</div>
