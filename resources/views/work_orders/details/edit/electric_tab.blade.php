<div class="tab-pane" id="electric" aria-labelledby="electric-tab" role="tabpanel" >
    <!-- Needs Drilling Operations Field -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- <div class="form-group col-sm-6">
                    <label class="form-label" for="electrical_operation_status">حالة تنفيذ الأعمال الكهربائية</label>{{$workOrder->electrical_operation->status}}
                    <select class="select2 form-select" name="electrical_operation_status" id="electrical_operation_status">
                        <option value="0" @if(isset($workOrder->electrical_operation->status) && $workOrder->electrical_operation->status == '0') selected @endif>لم يبدأ التنفيذ</option>
                        <option value="1" @if(isset($workOrder->electrical_operation->status) && $workOrder->electrical_operation->status == '1') selected @endif>جارى التنفيذ</option>
                        <option value="2" @if(isset($workOrder->electrical_operation->status) && $workOrder->electrical_operation->status == '2') selected @endif>تم التنفيذ</option>
                    </select>
                </div> --}}

                {{-- <div class="form-group col-sm-6">
                    <x-date-pickr name="electrical_complete_date" labelTitle="تاريخ التنفيذ" dateValue="{{$workOrder->electrical_operation->electrical_complete_date ?? null }}"></x-date-pickr>
                </div> --}}
            </div>
            <div class="row">
                <div class="form-group col-sm-2">
                    <label>الطبلون</label>
                    <div class="input-group">
                        <input type="number" name="tablun" class="touchspin" value="{{$workOrder->electrical_operation->tablun ?? 0 }}" />
                    </div>
                </div>
                <!--<div class="form-group col-sm-2">
                    <label>لحام</label>
                    <input type="text" name="welding" class="form-control" value="{{$workOrder->electrical_operation->welding ?? null }}" />
                </div>
                <div class="form-group col-sm-2">
                    <label>نوع اللحام</label>
                    <input type="text" name="welding_type" class="form-control" value="{{$workOrder->electrical_operation->welding_type ?? null }}" />
                </div>
                <div class="form-group col-sm-2">
                    <label>نهاية</label>
                    <input type="text" name="end" class="form-control" value="{{$workOrder->electrical_operation->end ?? null }}" />
                </div>
                <div class="form-group col-sm-2">
                    <label>نوع نهاية</label>
                    <input type="text" name="end_type" class="form-control" value="{{$workOrder->electrical_operation->end_type ?? null }}" />
                </div>-->

                <div class="form-group col-sm-2">
                    <label>رقم المخرج</label>
                    <input type="text" name="outlet_no" class="form-control" value="{{$workOrder->electrical_operation->outlet_no ?? null }}" />
                </div>
                <div class="form-group col-sm-2">
                    <label>الجهد</label>
                    <input type="text" name="voltage" class="form-control" value="{{$workOrder->electrical_operation->voltage ?? null }}" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>قاطع المحطة</label>
                    <input type="text" name="station_breaker" class="form-control" value="{{$workOrder->electrical_operation->station_breaker ?? null }}" />
                </div>
                <div class="form-group col-sm-6">
                    <label>عدد العدادات</label>
                    <div class="input-group">
                        <input type="number" name="total_electrical_counters" class="touchspin" value="{{$workOrder->electrical_operation->total_electrical_counters ?? 0 }}" />
                    </div>


                </div>
            </div>
            <div class="row p-1">
                <div class="float-right p-1">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#electric_meters">إضافة عداد</button>
                </div>
                <div
                    class="modal fade text-start"
                    id="electric_meters"
                    tabindex="-1"
                    aria-labelledby="electric_metersLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="electric_metersLabel">إضافة عداد</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>رقم العداد</label>
                                        <input type="text" id="add_meter_no" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>رقم الاشتراك</label>
                                        <input type="text" id="add_subscription_no" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label>السعة السابقة</label>
                                        <div class="input-group">
                                            <input type="text" id="add_previous_capacity" value="0" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>السعة المعتمدة</label>
                                        <div class="input-group">
                                            <input type="text" id="add_approved_capacity" value="0" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>القراءة السابقة</label>
                                        <div class="input-group">
                                            <input type="text" id="add_reading" value="0" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="add_electric_meters" class="btn btn-primary" data-bs-dismiss="modal">حفظ</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-responsive table-sm" id="electric_meters_table">
                        <thead>
                            <tr>
                                <th>رقم العداد</th>
                                <th>رقم الاشتراك</th>
                                <th>القراءة السابقة</th>
                                <th>السعة السابقة</th>
                                <th>السعة المعتمدة</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody id="electric_meters_rows">
                            @foreach($workOrder->meters as $meter)
                                <tr>
                                    <td><input type="hidden" name="meter_no[]" value="{{$meter->meter_no}}">{{$meter->meter_no}}</td>
                                    <td><input type="hidden" name="subscription_no[]" value="{{$meter->subscription_no}}">{{$meter->subscription_no}}</td>
                                    <td><input type="hidden" name="reading[]" value="{{$meter->reading}}">{{$meter->reading}}</td>
                                    <td><input type="hidden" name="previous_capacity[]" value="{{$meter->previous_capacity}}">{{$meter->previous_capacity}}</td>
                                    <td><input type="hidden" name="approved_capacity[]" value="{{$meter->approved_capacity}}">{{$meter->approved_capacity}}</td>
                                    <td><button type="button" class="btn btn-sm btn-danger del_meter">حذف</button> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <x-work-executed-info  
                    employeeFieldName="electrical_employee_id" 
                    contractorFieldName="electrical_contractor_id" 
                    workerTypeFieldName="electrical_worker_type" 
                    completeDateFieldName="electrical_complete_date"
                    :executedData="$workOrder->electrical_operation" 
                    labelTitle="لاعمال الكهرباء">
                </x-work-executed-info>
                {{-- <div class="row custom-options-checkable g-1">
                    <div class="col-md-3">
                        <input
                            class="custom-option-item-check"
                            type="radio"
                            name="electrical_worker_type"
                            id="electrical_worker_employee"
                            value="employee"
                            @if(!isset($workOrder->electrical_operation->electrical_worker_type) || $workOrder->electrical_operation->electrical_worker_type =='employee')
                            checked
                            @endif
                        />
                        <label class="custom-option-item p-1" for="electrical_worker_employee">
                          <span class="d-flex justify-content-between flex-wrap mb-50">
                            <span class="fw-bolder">نوع المنفذ - لاعمال الكهرباء</span>
                            <span class="fw-bolder">مراقب</span>
                          </span>
                        </label>
                    </div>

                    <div class="col-md-3">
                        <input
                            class="custom-option-item-check"
                            type="radio"
                            name="electrical_worker_type"
                            id="electrical_worker_contractor"
                            value="contractor"
                            @if(isset($workOrder->electrical_operation->electrical_worker_type) && $workOrder->electrical_operation->electrical_worker_type =='contractor')
                            checked
                            @endif
                        />
                        <label class="custom-option-item p-1" for="electrical_worker_contractor">
                          <span class="d-flex justify-content-between flex-wrap mb-50">
                            <span class="fw-bolder">نوع المنفذ - لاعمال الكهرباء</span>
                            <span class="fw-bolder">مقاول</span>
                          </span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6" id="electrical_employee_selector">
                        {!! Form::label('electrical_employee_id', 'كود / اسم المراقب') !!}
                        {!! Form::select('electrical_employee_id', $employees,$workOrder->electrical_operation->electrical_employee_id ?? null, ['class' => 'select2 form-select form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6" id="electrical_contractor_selector">
                        {!! Form::label('electrical_contractor_id', 'كود / اسم المقاول') !!}
                        {!! Form::select('electrical_contractor_id', $contractors,$workOrder->electrical_operation->electrical_contractor_id ?? null, ['class' => 'select2 form-select form-control']) !!}
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
