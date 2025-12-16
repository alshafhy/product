<div>
    <div class="mb-1">
        <label class="form-label" for="amount">أمر العمل</label>
        <input id="work_order_number" name="work_order_number" class="form-control" type="number"
            placeholder="رقم أمر العمل" />
    </div>
    <div class="row">
        <div class="mb-1 col-6">
            <x-date-pickr name="from_issue_date" :labelTitle="__('models/workOrderFollows.fields.from_issue_date')"></x-date-pickr>
        </div>
        <div class="mb-1 col-6">
            <x-date-pickr name="to_issue_date" :labelTitle="__('models/workOrderFollows.fields.to_issue_date')"></x-date-pickr>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-6">
            <x-date-pickr name="from_clearance_sdad_date" :labelTitle="__('models/workOrderFollows.fields.from_clearance_sdad_date')"></x-date-pickr>
        </div>
        <div class="mb-1 col-6">
            <x-date-pickr name="to_clearance_sdad_date" :labelTitle="__('models/workOrderFollows.fields.to_clearance_sdad_date')"></x-date-pickr>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-6">
            <x-date-pickr name="from_end_date" :labelTitle="__('models/workOrderFollows.fields.from_end_date')"></x-date-pickr>
        </div>
        <div class="mb-1 col-6">
            <x-date-pickr name="to_end_date" :labelTitle="__('models/workOrderFollows.fields.to_end_date')"></x-date-pickr>
        </div>
    </div>
</div>
