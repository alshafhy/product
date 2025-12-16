<fieldset class="border p-1 ">
    <legend class="float-none w-auto">معلومات الطول علي الطبيعة</legend>

    <div class="row">
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">تراب</span>:
            {{$workOrder->landscape->length_dust_before ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">أسفلت</span>:
            {{$workOrder->landscape->length_asphalt_before ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">رصيف</span>:
            {{$workOrder->landscape->length_sidewalk_before ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">إجمالي</span>:
            {{$workOrder->landscape->length_total_before ?? 'غير معرف' }}
        </div>
    </div>
</fieldset>

<div class="row m-1">
    <div class="col-md-3">
        <span class="fw-bolder text-primary">تم المسح</span>:
        @if(!isset($workOrder->landscape))
            <span class="badge bg-secondary">غير معرف</span>
        @elseif($workOrder->landscape->scanned)
            <span class="badge bg-success">نعم</span>
        @else
            <span class="badge bg-warning">لا</span>
        @endif
    </div>
    <div class="col-md-3">
        <span class="fw-bolder text-primary">يحتاج لبرنامج لحام</span>:
        @if(!isset($workOrder->landscape))
            <span class="badge bg-secondary">غير معرف</span>
        @elseif($workOrder->landscape->needs_welding_program)
            <span class="badge bg-success">نعم</span>
        @else
            <span class="badge bg-info">لا</span>
        @endif
    </div>
    <div class="col-md-3">
        <span class="fw-bolder text-primary">يوجد عوائق في الموقع</span>:
        @if(!isset($workOrder->landscape))
            <span class="badge bg-secondary">غير معرف</span>
        @elseif($workOrder->landscape->obstacles_exist_on_site)
            <span class="badge bg-success">نعم</span>
        @else
            <span class="badge bg-info">لا</span>
        @endif
    </div>
    <div class="col-md-3">
        <span class="fw-bolder text-primary">تاريخ عملية المسح الفعلي</span>:
        @if(isset($workOrder->landscape))
            {{$workOrder->landscape->landscape_date}}
        @else
            غير معرف
        @endif
    </div>
</div>
<div class="row m-1">
    <div class="col-md-4">
        <span class="fw-bolder text-primary">ملاحظات</span>:
        @if(isset($workOrder->landscape))
            {{$workOrder->landscape->note}}
        @else
            غير معرف
        @endif
    </div>
</div>
