<div class="card">
  <div class="card-body">
      <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" id="homeIcon-tab" data-bs-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true">

                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                  الطبقات</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="historyIcon-tab" data-bs-toggle="tab" href="#historyIcon" aria-controls="history" role="tab" aria-selected="true">

                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                  تاريخ الطبقات</a>
          </li>
      </ul>


      <div class="tab-content">
        <!-- firs layer tab  ------------------------------------------------------------------------------------>
          <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
              <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-4">
                  <div class=" pull-left"></div>

                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_layer_modal">
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
                          <th>الطبقة</th>
                          <th>تاريخ التنفيذ</th>
                          <th>المنفذ</th>
                          <th>نتيجة المختبر</th>
                          <th>سبب الرسوب</th>
                          <th>الإجراء</th>
                      </tr>
                      </thead>
                      <tbody id="layers_table">
                      @if(($landLayers))
                          @foreach($landLayers as $landLayer)
                              <tr id="tr{{$landLayer->id}}">
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td id="name{{ $landLayer->id }}">{{$landLayer->layer->name}}</td>
                                  <td id="start_date{{ $landLayer->id }}">{{$landLayer->start_date}}</td>
                                  <td id="end_date{{ $landLayer->id }}">{{$layer_worker_type_list[$landLayer->layer_worker_type]}}</td>
                                  <td id="lab_result_status{{ $landLayer->id }}">{{$labResultStatusList[$landLayer->lab_result_status]}}</td>
                                  <td id="note{{ $landLayer->id }}">{{$landLayer->note}}</td>
                                  <td>
                                      <div class='btn-group'>
                                          <a href="#" id="showId{{$landLayer->id}}" class='btn btn-outline-primary btn-sm show_data'>
                                              <i data-feather="eye"></i>
                                          </a>
                                          <a href="#" id="editId{{$landLayer->id}}" class='btn btn-outline-warning btn-sm edit_data'>
                                              <i data-feather="edit"></i>
                                          </a>
                                          <a href="#" id="deleteId{{$landLayer->id}}" class='btn btn-outline-danger btn-sm delete_data'>
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
          <!-- end layer detail  ------------------------------------------------------------------------------------>
          </div>
          <div class="tab-pane" id="historyIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
              <div class="table-responsive">
                  <table class="table table-striped table-hover table-responsive">
                      <thead>
                      <tr>
                          <th>{{('#')}}</th>
                          <th>النوع</th>
                          <th>الطبقة</th>
                          <th>نتيجة المختبر</th>
                          <th>سبب الرسوب</th>
                          <th>المنفذ</th>
                          <th>منشئ السجل</th>
                          <th>الإجراء</th>
                      </tr>
                      </thead>
                      <tbody id="layers_table">
                      @if(($workOrderFollow->landLayersHistory))
                          @foreach($workOrderFollow->landLayersHistory as $landLayer)
                              <tr id="tr{{$landLayer->id}}">
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td id="event_type{{ $landLayer->id }}">
                                      @if($landLayer->event_type=="created")
                                          إضافة
                                          @else
                                          تعديل
                                      @endif
                                  </td>
                                  <td id="name{{ $landLayer->id }}">{{$landLayer->layer->name}}</td>
                                  <td id="lab_result_status{{ $landLayer->id }}">{{$labResultStatusList[$landLayer->lab_result_status]}}</td>
                                  <td id="note{{ $landLayer->id }}">{{$landLayer->note}}</td>
                                  <td id="layer_worker_type{{ $landLayer->id }}">
                                      @if($landLayer->land_layer->layer_worker_type==2) الموظف - {{ $landLayer->land_layer->employee->name  }} @else المقاول - {{ $landLayer->land_layer->contractor->name }} @endif
                                  </td>
                                  <td id="user{{ $landLayer->id }}">{{$landLayer->user->name}}</td>
                                  <td>
                                      <div class='btn-group'>
                                          <a href="#" id="deleteId{{$landLayer->id}}" class='btn btn-outline-danger btn-sm delete_history'>
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

      </div>
  </div>
</div>
