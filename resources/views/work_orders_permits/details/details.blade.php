<div class="card border m-2">
  <div class="card-body">
      <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" id="homeIcon-tab" data-bs-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>التمديدات</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="profileIcon-tab" data-bs-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tool"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>الغرامات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="attachment-tab" data-bs-toggle="tab" href="#attachment" aria-controls="attachment" role="tab" aria-selected="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>المرفقات</a>
          </li>
      </ul>


      <div class="tab-content">
        <!-- firs detail tab  ------------------------------------------------------------------------------------>
          <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
              <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-4">
                  <div class=" pull-left"></div>
                  
                  <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_extension_modal">
                      اضافة
                  </button>
              </h4>
              <div class="alert alert-success d-none" id="success-msg"></div>
              <div class="alert alert-danger d-none" id="danger-msg"></div>
              
              <div class="table-responsive">
                  <table class="table table-striped table-hover table-responsive">
                      <tbody id="extensions_table">
                          <thead>
                              <tr>
                                  <th>{{('#')}}</th>
                                  <th>المعرف</th>
                                  
                                  <th>رقم السداد</th>
                                  <th>مدة التمديد</th>
                                  <th>تاريخ البدء</th>
                                  <th>تاريخ الانتهاء</th>
                                  <th>مبلغ التمديد</th>

                                  <th>{{('action')}}</th>
                              </tr>
                          </thead>
                          
                  
                          @if(($workOrdersPermitsExtensions))
                              @foreach($workOrdersPermitsExtensions as $workOrdersPermitsExtension)
                              @php ($modelId = $workOrdersPermitsExtension->id)

                              <tr id="tr{{$modelId}}">
                                  <th scope="row">{{ $loop->iteration }}</th>
                  
                                  <th scope="row">{{ $modelId }}</th>
                  
                                  <td id="sadad_number{{ $modelId }}">
                                      {{$workOrdersPermitsExtension->sadad_number}}
                                  </td>
                                  <td id="sadad_number{{ $modelId }}">
                                    {{$workOrdersPermitsExtension->period}}
                                    </td>

                                  <td id="from_date{{ $modelId }}">
                                      {{$workOrdersPermitsExtension->from_date}}
                                  </td>

                                  <td id="to_date{{ $modelId }}">
                                      {{$workOrdersPermitsExtension->to_date}}
                                  </td>
                  
                                  <td id="amount{{ $modelId }}">
                                      {{$workOrdersPermitsExtension->amount}}
                                  </td>
                  
                                  <td>
                                      <div class='btn-group'>
                                          <a href="#" id="showId{{$modelId ?? ''}}" class='btn btn-outline-primary btn-sm show_data'>
                                              <i data-feather="eye"></i>
                                          </a>
                                          <a href="#" id="editId{{$modelId ?? ''}}" class='btn btn-outline-warning btn-sm edit_data'>
                                              <i data-feather="edit"></i>
                                          </a>
                                          <a href="#" id="deleteId{{$modelId ?? ''}}" class='btn btn-outline-danger btn-sm delete_data'>
                                              <i data-feather="trash"></i>
                                          </a>
                                      </div>
                                  </td>
                              </tr>
                              @endforeach
                          @endif
                      </tbody>
                  </table>
              </div>
          <!-- end extension detail  ------------------------------------------------------------------------------------>
          </div>

          <!-- second details tab -------------------------------------------------------------------------------------->
          <div class="tab-pane" id="profileIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
              <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-4">
                  <div class=" pull-left"></div>
                  
                  <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_fine_modal">
                      اضافة
                  </button>
              </h4>
              <div class="alert alert-success d-none" id="success-msg"></div>
              <div class="alert alert-danger d-none" id="danger-msg"></div>
              
              <div class="table-responsive">
                  <table class="table table-striped table-hover table-responsive" id="fines_table">
                      <tbody>
                          <thead>
                              <tr>
                                  <th>{{('#')}}</th>
                                  <th>المعرف</th>
                                  
                                  <th>رقم السداد</th>
                                  <th>تاريخ الغرامة</th>
                                  <th>المبلغ</th>

                                  <th>{{('action')}}</th>
                              </tr>
                          </thead>
                          
                  
                          @if(($workOrdersPermitsFines))
                              @foreach($workOrdersPermitsFines as $workOrdersPermitsFine)
                              @php ($modelId = $workOrdersPermitsFine->id)

                              <tr id="tr{{$modelId}}">
                                  <th scope="row">{{ $loop->iteration }}</th>
                  
                                  <th scope="row">{{ $modelId }}</th>
                  
                                  <td id="sadad_number{{ $modelId }}">
                                      {{$workOrdersPermitsFine->sadad_number}}
                                  </td>

                                  <td id="from_date{{ $modelId }}">
                                      {{$workOrdersPermitsFine->issue_date}}
                                  </td>

                                  <td id="amount{{ $modelId }}">
                                      {{$workOrdersPermitsFine->amount}}
                                  </td>
                  

                                  <td>
                                      <div class='btn-group' id="fines_table_btns">
                                          <a href="#" id="showId{{$modelId ?? ''}}" class='btn btn-outline-primary btn-sm show_data2'>
                                              <i data-feather="eye"></i>
                                          </a>
                                          <a href="#" id="editId{{$modelId ?? ''}}" class='btn btn-outline-warning btn-sm edit_data2'>
                                              <i data-feather="edit"></i>
                                          </a>
                                          <a href="#" id="deleteId{{$modelId ?? ''}}" class='btn btn-outline-danger btn-sm delete_data2'>
                                              <i data-feather="trash"></i>
                                          </a>
                                      </div>
                                  </td>
                              </tr>
                              @endforeach
                          @endif
                      </tbody>
                  </table>
              </div>
          </div>
          <!-- end fine detail tab  ------------------------------------------------------------------------------------>

          @include('work_orders_permits.details.attachment')

      </div>
  </div>
</div>
