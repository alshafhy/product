<fieldset class="border p-1 ">
    <legend  class="float-none w-auto">معلومات الطول</legend>

    <div class="row m-1">
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">تراب</span>:
            {{$workOrder->landscape->length_dust ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">أسفلت</span>:
            {{$workOrder->landscape->length_asphalt ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">رصيف</span>:
            {{$workOrder->landscape->length_sidewalk ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">إجمالي</span>:
            {{$workOrder->landscape->length_total ?? 'غير معرف' }}
        </div>
    </div>
    <div class="row m-1">
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">طول كيبل  ضغط عالى</span>:
            {{$workOrder->landscape->cabel_length_hv ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">طول كيبل ضغط منخفض 300</span>:
            {{$workOrder->landscape->cabel_length_lv300 ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">طول كيبل ضغط منخفض 185</span>:
            {{$workOrder->landscape->cabel_length_lv185 ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">طول كيبل ضغط منخفض 70</span>:
            {{$workOrder->landscape->cabel_length_lv70 ?? 'غير معرف' }}
        </div>
    </div>
</fieldset>
<div class="row m-1">
    <div class="col-md-4">
        <span class="fw-bolder text-primary">نوع الحفر</span>:
        @if(!isset($workOrder->landscape))
            <span class="badge bg-secondary">غير معرف</span>
        @else
            <span class="badge bg-info">{{$workOrder->landscape->drilling_type}}</span>
        @endif
    </div>
    <div class="col-md-4">
        <span class="fw-bolder text-primary">عمق الحفرية</span>:
        @if(!isset($workOrder->landscape))
            <span class="badge bg-secondary">غير معرف</span>
        @else
            <span class="badge bg-info">{{$workOrder->landscape->drilling_deep}}</span>
        @endif
    </div>
</div>
