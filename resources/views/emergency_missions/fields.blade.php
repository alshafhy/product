<!-- Work Order Number Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('work_order_number', __('models/emergencyMissions.fields.work_order_number').':') !!}
    {!! Form::text('work_order_number', null, ['class' => 'form-control']) !!}
</div> --}}
<div class="form-group col-sm-3">
    {!! Form::label('mission_number', __('models/emergencyMissions.fields.mission_number').':') !!}
    @if ($formMode=="edit")
      @if(config("const.work_order_general_status.".$emergencyMission->status))
          <span class="badge rounded-pill {{config("const.work_order_general_status.".$emergencyMission->status.".class")}}">{{config("const.work_order_general_status.".$emergencyMission->status.".title")}}</span>
      @else
          {{$workOrderFollow->emergencyMission}}
      @endif
    @endif
    {!! Form::text('mission_number', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-3">
    <x-select2 name="mission_typeـid" :options="$missionTypes" :labelTitle="__('models/emergencyMissions.fields.mission_typeـid')"></x-select2>
</div>

<div class="form-group col-sm-3">
    <x-date-pickr name="received_date" :labelTitle="__('models/emergencyMissions.fields.received_date')"></x-date-pickr>
</div>
<div class="form-group col-sm-3">
    {!! Form::label('reference_number', __('models/emergencyMissions.fields.reference_number').':') !!}
    {!! Form::text('reference_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-3">
    <x-select2 name="parent_id" :options="$emergencyWorkOrders" :labelTitle="__('models/emergencyMissions.fields.parent_id')"></x-select2>
</div>
{{-- <div class="form-group col-sm-6">
    {!! Form::label('mission_typeـid', __('models/emergencyMissions.fields.mission_typeـid').':') !!}
    {!! Form::text('mission_typeـid', null, ['class' => 'form-control' ,'style' => 'form-control']) !!}
</div> --}}

<!-- District Id Field -->
<div class="form-group col-sm-3">
    <x-select2 name="district_id" :options="$districts" :labelTitle="__('models/emergencyMissions.fields.district_name')"></x-select2>
</div>


<!-- Street Name Field -->
<div class="form-group col-sm-3">
    {!! Form::label('street_name', __('models/emergencyMissions.fields.street_name').':') !!}
    {!! Form::text('street_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Number Field -->
<div class="form-group col-sm-3">
    {!! Form::label('customer_number', __('models/emergencyMissions.fields.customer_number').':') !!}
    {!! Form::text('customer_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Name Field -->
<div class="form-group col-sm-3">
    {!! Form::label('customer_name', __('models/emergencyMissions.fields.customer_name').':') !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
</div>
<!-- Customer Name Field -->
<div class="form-group col-sm-3">
    {!! Form::label('customer_mobile_number', __('models/emergencyMissions.fields.customer_mobile_number').':') !!}
    {!! Form::text('customer_mobile_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('mission_meter_number', __('models/emergencyMissions.fields.mission_meter_number').':') !!}
    {!! Form::text('mission_meter_number', $workOrderEmergencyMissions->mission_meter_number ?? null, ['class' => 'form-control']) !!}
</div>



{{-- <div class="form-group col-sm-6">
    {!! Form::label('mission_received_employee', __('models/emergencyMissions.fields.mission_received_employee').':') !!}
    {!! Form::text('mission_received_employee', null, ['class' => 'form-control']) !!}
</div> --}}
<div class="form-group col-sm-3">
    <x-select2 name="mission_received_employee" :defaultValue="$workOrderEmergencyMissions->mission_received_employee ?? null" :options="$missionReceivedEmployees" :labelTitle="__('models/emergencyMissions.fields.mission_received_employee')"></x-select2>
</div>



{{-- <div class="form-group col-sm-3">
    {!! Form::label('shift_number', __('models/emergencyMissions.fields.shift_number').':') !!}
    {!! Form::text('shift_number', null, ['class' => 'form-control']) !!}
</div> --}}
{{-- <div class="form-group col-sm-3">
    <x-select2 name="shift_number" :options="config('const.shift_number_list')" :labelTitle="__('models/emergencyMissions.fields.shift_number')"></x-select2>
</div> --}}

<div class="form-group col-sm-3">
    {!! Form::label('electricity_employee_name', __('models/emergencyMissions.fields.electricity_employee_name').':') !!}
    {!! Form::text('electricity_employee_name', $workOrderEmergencyMissions->electricity_employee_name ?? null, ['class' => 'form-control']) !!}
</div>



<div class="form-group col-sm-3">
    {!! Form::label('mission_operation_number', __('models/emergencyMissions.fields.mission_operation_number').':') !!}
    {!! Form::text('mission_operation_number', $workOrderEmergencyMissions->mission_operation_number ?? null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('electrical_station_number', __('models/emergencyMissions.fields.electrical_station_number').':') !!}
    {!! Form::text('electrical_station_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-3">
    <x-select2 name="emergency_issues_type_id" :options="$emergencyIssuesType" :defaultValue="$workOrderEmergencyMissions->emergency_issues_type_id ?? null" :labelTitle="__('models/emergencyIssuesTypes.plural')"></x-select2>
</div>

<div class="form-group col-sm-3 ">
    <x-select2 name="electricity_company_employee_id" :options="$electricityCompanyEmployees " :defaultValue="$workOrderEmergencyMissions->emergency_issues_type_id ?? null" :labelTitle="__('models/emergencyMissions.fields.electricity_company_employee_id')"></x-select2>
</div>
<div class="form-group col-sm-4">
    {!! Form::label('description', __('models/emergencyMissions.fields.description').':') !!}
    {!! Form::textArea('description', null, ['class' => 'form-control ','rows'=>2]) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('notes', __('models/emergencyMissions.fields.notes').':') !!}
    {!! Form::textArea('notes', null, ['class' => 'form-control ','rows'=>2]) !!}
</div>




<br><br><br><br><br><br>

@if ($formMode=="edit")
<section id="nav-filled">
  <div class="row match-height ">
    <!-- Filled Tabs starts -->
    <div class="col-xl-12 col-lg-12">
      <div class="card border" >
        <div class="card-header">
          <h4 class="card-title">التفاصيل</h4>
        </div>
        <div class="card-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-fill nav-tabs-border" id="myTab" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="home-tab-fill"
                data-bs-toggle="tab"
                href="#home-fill"
                role="tab"
                aria-controls="home-fill"
                aria-selected="true"
                >{{  __('models/emergencyMissions.attachments') }}</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="execution-tab-fill"
                data-bs-toggle="tab"
                href="#execution-fill"
                role="tab"
                aria-controls="execution-fill"
                aria-selected="true"
                >معلومات التنفيذ</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="profile-tab-fill"
                data-bs-toggle="tab"
                href="#profile-fill"
                role="tab"
                aria-controls="profile-fill"
                aria-selected="false"
                >سجل الملاحظات</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="messages-tab-fill"
                data-bs-toggle="tab"
                href="#messages-fill"
                role="tab"
                aria-controls="messages-fill"
                aria-selected="false"
                >موقع العمل</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="settings-tab-fill"
                data-bs-toggle="tab"
                href="#settings-fill"
                role="tab"
                aria-controls="settings-fill"
                aria-selected="false"
                >اعدادات</a
              >
            </li>

              <li class="nav-item">
                  <a class="nav-link" id="scan-tab" data-bs-toggle="tab" href="#actualWork" aria-controls="actualWork" role="tab" aria-selected="true">  أعمال الحفر </a>
              </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content pt-1">
            <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
              @include('emergency_missions.tabs.attachment_tab')
            </div>
            <div class="tab-pane" id="execution-fill" role="tabpanel" aria-labelledby="execution-tab-fill">
                <x-work-executed-info
                    employeeFieldName="mission_executed_employee_id"
                    contractorFieldName="mission_executed_contractor_id"
                    workerTypeFieldName="mission_executed_worker_type"
                    completeDateFieldName="mission_complete_date"
                    :executedData="$emergencyMission->emergencyMission"
                    labelTitle="منفذ البلاغ">
                </x-work-executed-info>
            </div>
            <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
              @include('emergency_missions.tabs.notes_tab')
            </div>
            <div class="tab-pane" id="messages-fill" role="tabpanel" aria-labelledby="messages-tab-fill">
              @include('emergency_missions.tabs.map_tab')
            </div>
            <div class="tab-pane" id="settings-fill" role="tabpanel" aria-labelledby="settings-tab-fill">
              @include('emergency_missions.tabs.settings_tab')
            </div>
              @include('emergency_missions.tabs.actual_work_tab')
          </div>
        </div>
      </div>
    </div>
      <!-- Filled Tabs ends -->

  </div>
</section>
@endif




<!-- Electrical Stations Type Id Field -->
{{-- <div class="form-group col-sm-6">
    <x-select2 name="electrical_stations_type_id" :options="$electricalStationsTypes" :labelTitle="__('models/workOrders.fields.electrical_stations_type_name')"></x-select2>
</div> --}}
