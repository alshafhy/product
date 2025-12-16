<!-- Work Order Id Field -->
{{-- <div class="form-group col-sm-12"> --}}
    @if (request()->route()->getName() != 'assayForms.edit')
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
    @else
        @include('work_orders.details.edit.fixed_info',['workOrder' => $assayForm->workOrder])
        {{ Form::hidden('work_order_id', $assayForm->work_order_id , array('id' => 'work_order_id')) }}
    @endif
{{-- </div> --}}
<!-- Notes Field -->
<div class="form-group col-sm-6 col-lg-6" style="max-height: 130px">
    {!! Form::label('notes', __('models/assayForms.fields.notes').':') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control h-75']) !!}
</div>

@if (request()->route()->getName() == 'assayForms.edit')
    <div class="col-sm-12 col-lg-12">
    <div class="card border m-2">
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profileIcon-tab" data-bs-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> بنود الاصناف </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="homeIcon-tab" data-bs-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tool"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg> بنود الاعمال </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="calculatorIcon-tab" data-bs-toggle="tab" href="#calculatorIcon" aria-controls="calculator" role="tab" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-speaker"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><circle cx="12" cy="14" r="4"></circle><line x1="12" y1="6" x2="12.01" y2="6"></line></svg>
                        الحاسبة
                    </a>
                </li>
            </ul>

            <script src="https://unpkg.com/vue@3"></script>

            <div class="tab-content">
                <div class="tab-pane" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
                    <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-4">
                        <div class=" pull-left"></div>

                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_services_modal">
                            اضافة
                        </button>
                        <div class="border rounded p-1">
                            <span class="bold">الإجمالي</span>:
                            <span id="total_service_price">{{ number_format($assaysServices->sum('price')) ?? 0 }}</span>
                        </div>
                    </h4>
                    <div class="alert alert-success d-none" id="success-msg"></div>
                    <div class="alert alert-danger d-none" id="danger-msg"></div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>{{('#')}}</th>
                                <th>وصف العمل</th>
                                <th>رقم البند</th>
                                <th>الكمية</th>
                                <th>سعر الوحدة</th>
                                <th>الإجمالي</th>
                                <th>الإجراء</th>
                            </tr>
                            </thead>
                            <tbody id="services_table">
                             @foreach($assaysServices as $assaysService)
                                <tr id="tr{{$assaysService->id}}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td id="service_name{{ $assaysService->id }}">
                                        {{$assaysService->service->name}}
                                    </td>
                                    <td id="service_code{{ $assaysService->id }}">
                                        {{$assaysService->service->code}}
                                    </td>
                                    <td id="quantity{{ $assaysService->id }}">
                                        {{$assaysService->quantity}}
                                    </td>
                                    <td id="service_price{{ $assaysService->id }}">
                                        {{number_format($assaysService->service->price,2)}}
                                    </td>
                                    <td id="price{{ $assaysService->id }}">
                                        {{number_format($assaysService->price,2)}}
                                    </td>
                                    <td>
                                        <div class='btn-group'>
                                            <a href="#" id="showId{{$assaysService->id}}" class='btn btn-outline-primary btn-sm show_data'>
                                                <i data-feather="eye"></i>
                                            </a>
                                            <a href="#" id="editId{{$assaysService->id}}" class='btn btn-outline-warning btn-sm edit_data'>
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="#" id="deleteId{{$assaysService->id}}" class='btn btn-outline-danger btn-sm delete_data'>
                                                <i data-feather="trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                             @endforeach
                             </tbody>
                        </table>
                    </div>
                    <!-- end extension detail  -->
                </div>

                <div class="tab-pane active" id="profileIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
                    <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-4">
                        <div class=" pull-left"></div>

                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_item_modal">
                            اضافة
                        </button>
                    </h4>
                    <div class="alert alert-success d-none" id="success-msg"></div>
                    <div class="alert alert-danger d-none" id="danger-msg"></div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>{{('#')}}</th>
                                <th>المادة</th>
                                <th>رقم البند</th>
                                <th>صرف</th>
                                <th>مستخدم</th>
                                <th>ارجاع</th>
                                <th>باقي صرف</th>

                                <th>الإجراء</th>
                            </tr>
                            </thead>
                            <tbody id="items_table">
                             @foreach($assaysItems as $assaysItem)
                                <tr id="tr{{$assaysItem->id}}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td id="item_name{{ $assaysItem->id }}">
                                        {{$assaysItem->item->name}}
                                    </td>

                                    <td id="item_code{{ $assaysItem->id }}">
                                        {{$assaysItem->item->code}}
                                    </td>

                                    <td id="spend{{ $assaysItem->id }}">
                                        {{$assaysItem->spend}}
                                    </td>

                                    <td id="used{{ $assaysItem->id }}">
                                        {{$assaysItem->used}}
                                    </td>

                                    <td id="returned{{ $assaysItem->id }}">
                                        {{$assaysItem->returned}}
                                    </td>

                                    <td id="returned_spend{{ $assaysItem->id }}">
                                        {{$assaysItem->returned_spend}}
                                    </td>

                                    <td>
                                        <div class='btn-group' id="fines_table_btns">
                                            <a href="#" id="showId{{$assaysItem->id}}" class='btn btn-outline-primary btn-sm show_data2'>
                                                <i data-feather="eye"></i>
                                            </a>
                                            <a href="#" id="editId{{$assaysItem->id}}" class='btn btn-outline-warning btn-sm edit_data2'>
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="#" id="deleteId{{$assaysItem->id}}" class='btn btn-outline-danger btn-sm delete_data2'>
                                                <i data-feather="trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="calculatorIcon" aria-labelledby="calculatorIcon-tab" role="tabpanel">
                    <div class="alert alert-success d-none" id="success-msg"></div>
                    <div class="alert alert-danger d-none" id="danger-msg"></div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            @include("assay_forms.Components.calculator1")
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            @include("assay_forms.Components.calculator2")
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            @include("assay_forms.Components.calculator3")
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endif

@push('page-script')
    <script>
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
    </script>
@endpush
