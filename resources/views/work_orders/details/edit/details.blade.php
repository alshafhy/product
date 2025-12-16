
<div style="margin-top: 25px;" class="col-xl-12 col-lg-12">
    <div class="card border" >
      <div class="card-header">
        <h4 class="card-title">التفاصيل</h4>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" aria-controls="general" role="tab" aria-selected="true" >اعدادات عامة</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="workOrderNotes-tab" data-bs-toggle="tab" href="#workOrderNotes" aria-controls="workOrderNotes" role="tab" aria-selected="false">سجل الملاحظات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="map-tab" data-bs-toggle="tab" href="#location" aria-controls="location" role="tab" aria-selected="false">الموقع على الخريطة</a>
          </li>

          @if ($mode == "drilling" || $mode == "drillingProjects" ||$mode == "electricTowers")
            <li class="nav-item">
                <a class="nav-link" id="scan-tab" data-bs-toggle="tab" href="#scan" aria-controls="scan" role="tab" aria-selected="true">معلومات المسح على الطبيعة</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="scan-tab" data-bs-toggle="tab" href="#actualWork" aria-controls="actualWork" role="tab" aria-selected="true">  معلومات التنفيذ </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="observer-tab" data-bs-toggle="tab" href="#observer" aria-controls="observer" role="tab" aria-selected="true">معلومات المراقب / المقاول</a>
            </li>
            
          @endif

          @if ($mode == "electricity"||$mode == "drilling" || $mode == "drillingProjects" || $mode == "electricTowers")
            <li class="nav-item">
                <a class="nav-link" id="electric-tab" data-bs-toggle="tab" href="#electric" aria-controls="electric" role="tab" aria-selected="true">الاعمال الكهربائية</a>
            </li>
          @endif

          @if ($mode == "electricTowers")
            <li class="nav-item">
                <a class="nav-link" id="electric-tower" data-bs-toggle="tab" href="#electric_tower" aria-controls="electric_tower" role="tab" aria-selected="true">الهوائي</a>
            </li>
          @endif

          <li class="nav-item">
              <a class="nav-link" id="attachment-tab" data-bs-toggle="tab" href="#attachment" aria-controls="attachment" role="tab" aria-selected="false">المرفقات</a>
          </li>
          
          {{-- <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">التصاريح</a>
          </li> --}}
          {{-- <li class="nav-item">
            <a href="disabled" id="disabled-tab" class="nav-link disabled">Disabled</a>
          </li> --}}
          
          {{-- <li class="nav-item">
            <a class="nav-link" id="about-tab" data-bs-toggle="tab" href="#about" aria-controls="about" role="tab" aria-selected="false">تفاصيل الحفر</a>
          </li> --}}
        </ul>
        <div class="tab-content border">
          @include('work_orders.details.edit.general_tab')
          @include('work_orders.details.edit.notes_tab')
          @include('work_orders.details.edit.map_tab')
          @if ($mode == "drilling" || $mode == "drillingProjects" ||  $mode == "electricTowers")
            @include('work_orders.details.edit.scan_tab')
            @include('work_orders.details.edit.actual_work_tab')
            @include('work_orders.details.edit.observer_tab')
          @endif

          @if ($mode == "electricity" || $mode == "drilling" || $mode == "drillingProjects" ||  $mode == "electricTowers")
            @include('work_orders.details.edit.electric_tab') 
          @endif

          @if ($mode == "electricTowers")
            @include('work_orders.details.edit.electric_tower')
          @endif
          

          @include('work_orders.details.edit.attachment_tab')

          {{-- <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
           
            <p>
              Dragée jujubes caramels tootsie roll gummies gummies icing bonbon. Candy jujubes cake cotton candy.
              Jelly-o lollipop oat cake marshmallow fruitcake candy canes toffee. Jelly oat cake pudding jelly beans
              brownie lemon drops ice cream halvah muffin. Brownie candy tiramisu macaroon tootsie roll danish.
            </p>
            <p>
              Croissant pie cheesecake sweet roll. Gummi bears cotton candy tart jelly-o caramels apple pie jelly
              danish marshmallow. Icing caramels lollipop topping. Bear claw powder sesame snaps.
            </p>
          </div> --}}
          
          {{-- <div class="tab-pane" id="about" aria-labelledby="about-tab" role="tabpanel">
            <p>
              Gingerbread cake cheesecake lollipop topping bonbon chocolate sesame snaps. Dessert macaroon bonbon
              carrot cake biscuit. Lollipop lemon drops cake gingerbread liquorice. Sweet gummies dragée. Donut bear
              claw pie halvah oat cake cotton candy sweet roll. Cotton candy sweet roll donut ice cream.
            </p>
            <p>
              Halvah bonbon topping halvah ice cream cake candy. Wafer gummi bears chocolate cake topping powder.
              Sweet marzipan cheesecake jelly-o powder wafer lemon drops lollipop cotton candy.
            </p>
          </div> --}}

        </div>
      </div>
    </div>
  </div>

  @push('page-script')
    <script>
        @if(count($workOrder->meters) == 0)
        $('#electric_meters_table').hide();
        @endif
        $(document).on('click','.del_meter',function (e) {
            $(this).parent().parent().remove();
            let rows = $("#electric_meters_table tr").length;
            //console.dir(rows);
            if (rows === 1){
                $('#electric_meters_table').hide();
            }
        });
        $('#add_electric_meters').on('click',function (e) {
            $('#electric_meters_table').show();
            let meter_no = $('#add_meter_no').val();
            let subscription_no = $('#add_subscription_no').val();
            let reading = $('#add_reading').val();
            let previous_capacity = $('#add_previous_capacity').val();
            let approved_capacity = $('#add_approved_capacity').val();
            if(meter_no === ''){
                return '';
            }
            if(subscription_no === ''){
                return '';
            }
            $('#electric_meters_rows').append('<tr>' +
                '<td><input type="hidden" name="meter_no[]" value="'+meter_no+'"> '+meter_no+'</td>' +
                '<td><input type="hidden" name="subscription_no[]" value="'+subscription_no+'">'+subscription_no+'</td>' +
                '<td><input type="hidden" name="reading[]" value="'+reading+'">'+reading+'</td>' +
                '<td><input type="hidden" name="previous_capacity[]" value="'+previous_capacity+'">'+previous_capacity+'</td>' +
                '<td><input type="hidden" name="approved_capacity[]" value="'+approved_capacity+'">'+approved_capacity+'</td>' +
                '<td><button type="button" class="btn btn-sm btn-danger del_meter">حذف</button> </td>' +
                '</tr>');
        });
        // $('input[name=electrical_worker_type]').on('click',function (e) {
        //     if($(this).val() === 'contractor'){
        //         $("#electrical_contractor_selector").show();
        //         $("#electrical_employee_selector").hide();
        //     }else{
        //         $("#electrical_contractor_selector").hide();
        //         $("#electrical_employee_selector").show();
        //     }
        // });
        // @if(isset($workOrder->electrical_operation->electrical_worker_type) && $workOrder->electrical_operation->electrical_worker_type =='contractor')
        // $("#electrical_contractor_selector").show();
        // $("#electrical_employee_selector").hide();
        // @else
        // $("#electrical_contractor_selector").hide();
        // $("#electrical_employee_selector").show();
        // @endif
        // $('input[name=drilling_worker_type]').on('click',function (e) {
        //     if($(this).val() === 'contractor'){
        //         $("#contractor_selector").show();
        //         $("#employee_selector").hide();
        //     }else{
        //         $("#contractor_selector").hide();
        //         $("#employee_selector").show();
        //     }
        // });
        // @if(isset($workOrder->landscape->drilling_worker_type) && $workOrder->landscape->drilling_worker_type =='contractor')
        // $("#contractor_selector").show();
        // $("#employee_selector").hide();
        // @else
        // $("#contractor_selector").hide();
        // $("#employee_selector").show();
        // @endif
    </script>
@endpush
