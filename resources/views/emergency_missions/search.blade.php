<div class="card">
    {{-- <input type="text" name="status" class="form-control searchEmail" placeholder="Search for Email Only..."> --}}

    {{-- {!! Form::model($workOrdersPermitType, ['route' => ['workOrdersPermitTypes.update', $workOrdersPermitType->id], 'method' => 'patch']) !!} --}}
    <form action="" id="search_data">
        <div class="card-header">
            <h4 class="card-title"> @lang('crud.advancedSearch')  </h4>
            {{-- {!! Form::submit(__('crud.search'), ['class' => 'btn btn-primary']) !!} --}}
            <button id="searchButton" class="btn btn-primary" type="button"> @lang('crud.doSearch') </button>
            {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersPermitTypes','action_name' => 'edit']) --}}
        </div>
        <div class="card-body">
            <div class="row">

                <div class="form-group col-sm-3">
                    {!! Form::label('mission_number', __('models/emergencyMissions.fields.mission_number').':') !!}
                    {!! Form::text('mission_number',null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-sm-3">
                    {!! Form::label('parent_work_order', __('models/workOrders.fields.work_order_number').':') !!}
                    {!! Form::text('parent_work_order', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Received Date Field -->
                <div class="form-group col-sm-3">
                    <x-date-pickr name="received_date" :labelTitle="__('models/workOrders.fields.received_date')"></x-date-pickr>
                </div>

                <div class="form-group col-sm-3">
                    {!! Form::label('mission_received_employee', __('models/emergencyMissions.fields.mission_received_employee_short').':') !!}
                    {!! Form::text('mission_received_employee', null, ['class' => 'form-control']) !!}
                </div>

                <!-- District Id Field -->
                <div class="form-group col-sm-3">
                    <x-select2 name="district_id" :options="$districts" :labelTitle="__('models/workOrders.fields.district_name')"></x-select2>
                </div>

                <!-- Customer Number Field -->
                <div class="form-group col-sm-3">
                    {!! Form::label('customer_number', __('models/emergencyMissions.fields.customer_number').':') !!}
                    {!! Form::text('customer_number', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Customer Name Field -->
                <div class="form-group col-sm-3">
                    {!! Form::label('reference_number', __('models/workOrders.fields.reference_number').':') !!}
                    {!! Form::text('reference_number', null, ['class' => 'form-control']) !!}
                </div>
                <!-- Customer Name Field -->
                <div class="form-group col-sm-3">
                    {!! Form::label('status', __('models/workOrders.fields.status').':') !!}
                    {!! Form::select('status', $workOrderStatus,null, ['class' => 'select2 form-select form-control']) !!}
                </div>
                <!-- Customer Name Field -->
                <div class="form-group col-sm-3">
                    {!! Form::label('current_department_id', __('models/workOrders.fields.department_name').':') !!}
                    {!! Form::select('current_department_id', $currentDepartment ,null, ['class' => 'select2 form-select form-control']) !!}
                </div>


            </div>
        </div>

        {{-- <div class="card-footer">
            {!! Form::submit(__('crud.search'), ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('workOrdersPermitTypes.index') }}" class="btn btn-default">
                @lang('crud.cancel')
            </a>
        </div> --}}
    </form>

    {{-- {!! Form::close() !!} --}}

</div>
@push('page-script')

    <script type="text/javascript">
        $(function () {

          var table = $('.data-table').DataTable();
          $(".search").keyup(function(){
            search(table);
          });

          $("#searchButton").click(function(){
            search(table);
          });
        });

        function search(table) {
            var $form = $("#search_data");
            var data = getFormData($form);
            console.log(data);
            console.log(JSON.stringify(data));
            jsonData = {'searchData':data};
            table.search( JSON.stringify(jsonData) ).draw();
            //   table.search( {'status':this.value} ).draw();
            $('input[type="search"]').val('');
        }

        function getFormData($form){
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }
      </script>

@endpush
