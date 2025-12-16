<div class="tab-pane" id="observer" aria-labelledby="observer-tab" role="tabpanel" >
    <!-- Needs Drilling Operations Field -->
    <div class="card">
        <div class="card-body">
            <x-work-executed-info  
                employeeFieldName="drilling_employee_id" 
                contractorFieldName="drilling_contractor_id" 
                workerTypeFieldName="drilling_worker_type" 
                completeDateFieldName="drilling_complete_date"
                :executedData="$workOrder->landscape" 
                labelTitle="لاعمال الحفر">
            </x-work-executed-info>
            {{-- <div class="row custom-options-checkable g-1">
                <div class="col-md-3">
                    <input
                        class="custom-option-item-check"
                        type="radio"
                        name="drilling_worker_type"
                        id="employee"
                        value="employee"
                        @if(!isset($workOrder->landscape->drilling_worker_type) || $workOrder->landscape->drilling_worker_type =='employee')
                        checked
                        @endif
                    />
                    <label class="custom-option-item p-1" for="employee">
                      <span class="d-flex justify-content-between flex-wrap mb-50">
                        <span class="fw-bolder">نوع المنفذ - لاعمال الحفر</span>
                        <span class="fw-bolder">مراقب</span>
                      </span>
                    </label>
                </div>

                <div class="col-md-3">
                    <input
                        class="custom-option-item-check"
                        type="radio"
                        name="drilling_worker_type"
                        id="contractor"
                        value="contractor"
                    @if(isset($workOrder->landscape->drilling_worker_type) && $workOrder->landscape->drilling_worker_type =='contractor')
                        checked
                    @endif
                    />
                    <label class="custom-option-item p-1" for="contractor">
                      <span class="d-flex justify-content-between flex-wrap mb-50">
                        <span class="fw-bolder">نوع المنفذ - لاعمال الحفر</span>
                        <span class="fw-bolder">مقاول</span>
                      </span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6" id="employee_selector">
                    {!! Form::label('drilling_employee_id', 'كود / اسم المراقب') !!}
                    {!! Form::select('drilling_employee_id', $employees,$workOrder->landscape->drilling_employee_id ?? null, ['class' => 'select2 form-select form-control']) !!}
                </div>
                <div class="form-group col-sm-6" id="contractor_selector">
                    {!! Form::label('drilling_contractor_id', 'كود / اسم المقاول') !!}
                    {!! Form::select('drilling_contractor_id', $contractors,$workOrder->landscape->drilling_contractor_id ?? null, ['class' => 'select2 form-select form-control']) !!}
                </div>
            </div> --}}
        </div>
    </div>
</div>
