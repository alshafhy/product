<div class="tab-pane active " id="general" aria-labelledby="general-tab" role="tabpanel" >
    <!-- Needs Drilling Operations Field -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-6">
                    <x-custom-switch name="needs_drilling_operations" :labelTitle="__('models/workOrders.fields.needs_drilling_operations')"></x-custom-switch>
                </div>

                <!-- 'bootstrap / Toggle Switch needs electrical work Work Field' -->
                <div class="form-group col-sm-6">
                    {{-- <x-check-box name="needs_electrical_work" :labelTitle="__('models/workOrders.fields.needs_electrical_work')"></x-check-box> --}}
                    <x-custom-switch name="needs_electrical_work" :labelTitle="__('models/workOrders.fields.needs_electrical_work')"></x-custom-switch>
                </div>

                <!-- 'bootstrap / Toggle Switch Needs Work Orders Permit Field' -->
                <div class="form-group col-sm-6">
                    <x-custom-switch name="needs_work_orders_permit" :labelTitle="__('models/workOrders.fields.needs_work_orders_permit')"></x-custom-switch>
                </div>
                @if (!$workOrder->current_department_id)
                <div class="form-group col-sm-6">
                    <x-select2 name="owner_department_id" :options="$departmentsList" :labelTitle="__('models/workOrders.fields.target_department')"></x-select2> 
                </div>
                @endif
                 
                {{-- <div class="form-group col-sm-6">
                    <x-custom-switch name="is_project" :labelTitle="__('models/workOrders.fields.is_project')"></x-custom-switch>
                </div> --}}
            </div>
        </div>
    </div>
</div>