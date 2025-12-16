
    <div class="row m-1">
        <div class="col-sm-4">
            <span class="fw-bolder text-primary">عامود ١٠</span>:
            {{$workOrder->electricity_tower->tower10 ?? 'غير معرف' }}
        </div>
        <div class="col-sm-4">
            <span class="fw-bolder text-primary">عامود ١٣</span>:
            {{$workOrder->electricity_tower->tower13 ?? 'غير معرف' }}
        </div>
        <div class="col-sm-4">
            <span class="fw-bolder text-primary">محول</span>:
            {{$workOrder->electricity_tower->converter ?? 'غير معرف' }}
        </div>
    </div>
    <div class="row m-1">
        <div class="col-sm-4">
            <span class="fw-bolder text-primary">شداد</span>:
            {{$workOrder->electricity_tower->shadad ?? 'غير معرف' }}
        </div>
        <div class="col-sm-4">
            <span class="fw-bolder text-primary">شبكة ض/ع</span>:
            {{$workOrder->electricity_tower->grid_high_voltage ?? 'غير معرف' }}
        </div>
        <div class="col-sm-4">
            <span class="fw-bolder text-primary">شبكة ض/م</span>:
            {{$workOrder->electricity_tower->grid_low_voltage ?? 'غير معرف' }}
        </div>

    </div>
