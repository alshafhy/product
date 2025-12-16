
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.services_category_id').' :' }}
        </div>
        <div class="col-sm-9">
            # {{ $servicesCategory->id }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.name').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $servicesCategory->name }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.name_ar').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $servicesCategory->name_ar }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.created_at').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $servicesCategory->created_at }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            {{ __('models/workOrderServices.fields.updated_at').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $servicesCategory->updated_at }}
        </div>
    </div>
</div>

