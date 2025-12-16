<div class="tab-pane" id="actualWork" aria-labelledby="actualWork-tab" role="tabpanel" >
    <!-- Needs Drilling Operations Field -->
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="form-group col-sm-4">
                    <x-select2 name="asbuilt_status" :options="config('const.asbuilt_status')" :labelTitle="__('models/workOrders.fields.asbuilt_status')"></x-select2> 
                </div>
                <fieldset class="border p-1 ">
                    <legend  class="float-none w-auto">معلومات الطول</legend>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>تراب</label>
                            <div class="input-group">
                                <input type="number" id="length_dust" name="length_dust" class="touchspinA" onchange="calcTotalActual()"  value="{{$emergencyMission->landscape->length_dust ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>أسفلت</label>
                            <div class="input-group">
                                <input type="number" id="length_asphalt" name="length_asphalt" class="touchspinA" onchange="calcTotalActual()"  value="{{$emergencyMission->landscape->length_asphalt ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>رصيف</label>
                            <div class="input-group">
                                <input type="number" id="length_sidewalk" name="length_sidewalk" class="touchspinA" onchange="calcTotalActual()"  value="{{$emergencyMission->landscape->length_sidewalk ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>إجمالي</label>
                            <div class="input-group">
                                <input type="number" id="length_total" name="length_total" class="touchspinA" onchange="calcTotalActual()"  value="{{$emergencyMission->landscape->length_total ?? 0 }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>طول كيبل  ضغط عالى</label>
                            <div class="input-group">
                                <input type="number" id="cabel_length_hv" name="cabel_length_hv" class="touchspinA" onchange="calcTotalActual()"  value="{{$emergencyMission->landscape->cabel_length_hv ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>طول كيبل ضغط منخفض 70</label>
                            <div class="input-group">
                                <input type="number" id="cabel_length_lv70" name="cabel_length_lv70" class="touchspinA" onchange="calcTotalActual()"  value="{{$emergencyMission->landscape->cabel_length_lv70 ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>طول كيبل ضغط منخفض 185</label>
                            <div class="input-group">
                                <input type="number" id="cabel_length_lv185" name="cabel_length_lv185" class="touchspinA" onchange="calcTotalActual()"  value="{{$emergencyMission->landscape->cabel_length_lv185 ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>طول كيبل ضغط منخفض 300</label>
                            <div class="input-group">
                                <input type="number" id="cabel_length_lv300" name="cabel_length_lv300" class="touchspinA" value="{{$emergencyMission->landscape->cabel_length_lv300 ?? 0 }}" />
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="form-label" for="drilling_type">نوع الحفر</label>
                    <select class="select2 form-select" name="drilling_type" id="drilling_type">
                        <option value="">اختار</option>
                        <option value="مفتوح" @if(isset($emergencyMission->landscape->drilling_type) && $emergencyMission->landscape->drilling_type == 'مفتوح') selected @endif>مفتوح</option>
                        <option value="Microtrench" @if(isset($emergencyMission->landscape->drilling_type) && $emergencyMission->landscape->drilling_type == 'Microtrench') selected @endif>Microtrench</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label>عمق الحفرية</label>
                    <div class="input-group">
                        <input type="number" id="drilling_deep" name="drilling_deep" class="touchspinA" onchange="calcTotalActual()"  value="{{$emergencyMission->landscape->drilling_deep ?? 0 }}" />
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="form-group col-sm-4">
                    <x-date-pickr name="landscape_date" labelTitle="تاريخ عملية المسح الفعلي" dateValue="{{$workOrder->landscape->landscape_date ?? null }}"></x-date-pickr>
                </div>
                <div class="form-group col-sm-4">
                    <label>عدد الطبقات المطلوبة</label>
                    <div class="input-group">
                        <input type="number" name="drilling_layer" class="touchspinA" onchange="calcTotalActual()"  value="{{$workOrder->landscape->drilling_layer ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label>عمق الحفرية</label>
                    <div class="input-group">
                        <input type="number" id="drilling_deep" name="drilling_deep" class="touchspinA" onchange="calcTotalActual()"  value="{{$workOrder->landscape->drilling_deep ?? 0 }}" />
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="form-group col-sm-12">
                    {!! Form::label('note', 'ملاحظات') !!}
                    {!! Form::textarea('note',  $emergencyMission->landscape->note ?? null, ['class' => 'form-control', 'rows'=>'2']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@push('page-script')
<script>
    $("#length_total").prop("readonly", true);

    function calcTotalActual() {
        const total =  parseFloat($("#length_dust").val()) + parseFloat($("#length_asphalt").val()) + parseFloat($("#length_sidewalk").val());
        $("#length_total").val(total);
    }

    $(".touchspinA").TouchSpin({
                min: 0,
                max: 9999,
                step: 1,
                decimals: 2,
                forcestepdivisibility: 'none',
                // boostat: 5,
                // maxboostedstep: 10,
                // postfix: '%'
            });
</script>
@endpush
