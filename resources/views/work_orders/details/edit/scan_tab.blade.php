<div class="tab-pane" id="scan" aria-labelledby="scan-tab" role="tabpanel" >
    <!-- Needs Drilling Operations Field -->
    <div class="card">
        <div class="card-body">
            
            <div class="row">
                <div class="form-group col-sm-4">
                    <x-custom-switch name="scanned" isCheckedByDefault="{{$workOrder->landscape->scanned ?? 0}}" labelTitle="تم المسح"></x-custom-switch>
                </div>

                <!-- 'bootstrap / Toggle Switch needs electrical work Work Field' -->
                <div class="form-group col-sm-4">
                    {{-- <x-check-box name="needs_electrical_work" :labelTitle="__('models/workOrders.fields.needs_electrical_work')"></x-check-box> --}}
                    <x-custom-switch name="needs_welding_program" isCheckedByDefault="{{$workOrder->landscape->needs_welding_program ?? 0}}" labelTitle="يحتاج لبرنامج لحام"></x-custom-switch>
                </div>

                <!-- 'bootstrap / Toggle Switch Needs Work Orders Permit Field' -->
                <div class="form-group col-sm-4">
                    <x-custom-switch name="obstacles_exist_on_site" isCheckedByDefault="{{$workOrder->landscape->obstacles_exist_on_site ?? 0}}" labelTitle="يوجد عوائق في الموقع"></x-custom-switch>
                </div>
            </div>
            {{-- <div class="row">
                <div class="form-group col-sm-4">
                    <label class="form-label" for="drilling_type">نوع الحفر</label>
                    <select class="select2 form-select" name="drilling_type" id="drilling_type">
                        <option value="مفتوح" @if(isset($workOrder->landscape->drilling_type) && $workOrder->landscape->drilling_type == 'مفتوح') selected @endif>مفتوح</option>
                        <option value="Microtrench" @if(isset($workOrder->landscape->drilling_type) && $workOrder->landscape->drilling_type == 'Microtrench') selected @endif>Microtrench</option>
                    </select>
                </div>
            </div> --}}
            {{-- <div class="row">
                <fieldset class="border p-1 m-1">
                    <legend  class="float-none w-auto">عدد المقاطع</legend>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>تراب</label>
                            <div class="input-group">
                                <input name="number_of_clips_dust" type="number" class="touchspin" value="{{$workOrder->landscape->number_of_clips_dust ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>أسفلت</label>
                            <div class="input-group">
                                <input type="number" name="number_of_clips_asphalt" class="touchspin" value="{{$workOrder->landscape->number_of_clips_asphalt ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>رصيف</label>
                            <div class="input-group">
                                <input type="number" name="number_of_clips_sidewalk" class="touchspin" value="{{$workOrder->landscape->number_of_clips_sidewalk ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>إجمالي</label>
                            <div class="input-group">
                                <input type="number" name="number_of_clips_total" class="touchspin" value="{{$workOrder->landscape->number_of_clips_total ?? 0 }}" />
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div> --}}
            {{-- <div class="row">
                <fieldset class="border p-1 m-1">
                    <legend  class="float-none w-auto">معلومات الطول</legend>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>تراب</label>
                            <div class="input-group">
                                <input type="number" name="length_dust" class="touchspin" value="{{$workOrder->landscape->length_dust ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>أسفلت</label>
                            <div class="input-group">
                                <input type="number" name="length_asphalt" class="touchspin" value="{{$workOrder->landscape->length_asphalt ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>رصيف</label>
                            <div class="input-group">
                                <input type="number" name="length_sidewalk" class="touchspin" value="{{$workOrder->landscape->length_sidewalk ?? 0 }}" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>إجمالي</label>
                            <div class="input-group">
                                <input type="number" name="length_total" class="touchspin" value="{{$workOrder->landscape->length_total ?? 0 }}" />
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div> --}}
            <br>
            <div class="row">
                <div class="form-group col-sm-4">
                    <x-date-pickr name="landscape_date" labelTitle="تاريخ عملية المسح الفعلى (تاريخ رفع الكميات من الموقع)" dateValue="{{$workOrder->landscape->landscape_date }}"></x-date-pickr>
                </div>
                {{-- <div class="form-group col-sm-4">
                    <label>عدد الطبقات المطلوبة</label>
                    <div class="input-group">
                        <input type="number" name="drilling_layer" class="touchspin" value="{{$workOrder->landscape->drilling_layer ?? 0 }}" />
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label>عمق الحفرية</label>
                    <div class="input-group">
                        <input type="number" name="drilling_deep" class="touchspin" value="{{$workOrder->landscape->drilling_deep ?? 0 }}" />
                    </div>
                </div> --}}
            </div>
            <br>
            <fieldset class="border p-1 ">
                <legend  class="float-none w-auto">معلومات الطول علي الطبيعة</legend>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label>تراب</label>
                        <div class="input-group">
                            <input type="number" id="length_dust_before"  name="length_dust_before" class="touchspinC" onchange="calcTotal()" value="{{$workOrder->landscape->length_dust_before ?? 0 }}" />
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>أسفلت</label>
                        <div class="input-group">
                            <input type="number" id="length_asphalt_before" name="length_asphalt_before" class="touchspinC" onchange="calcTotal()" value="{{$workOrder->landscape->length_asphalt_before ?? 0 }}" />
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>رصيف</label>
                        <div class="input-group">
                            <input type="number" id="length_sidewalk_before" name="length_sidewalk_before" class="touchspinC" onchange="calcTotal()" value="{{$workOrder->landscape->length_sidewalk_before ?? 0 }}" />
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>إجمالي</label>
                        <div class="input-group">
                            <input type="number" id="length_total_before" name="length_total_before" class="touchspinC" onchange="calcTotal()" value="{{$workOrder->landscape->length_total_before ?? 0 }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            {{-- <div class="row">
                <div class="form-group col-sm-4">
                    {!! Form::label('note', 'ملاحظات') !!}
                    {!! Form::textarea('note',  $workOrder->landscape->note ?? null, ['class' => 'form-control']) !!}
                </div>
            </div> --}}
        </div>
    </div>
</div>
@push('page-script')
<script>
    // $('.touchspin').TouchSpin({
    //     max: 300,
    //   });
    $("#length_total_before").prop("readonly", true);

    function calcTotal() {
        let total =  parseFloat($("#length_dust_before").val()) + parseFloat($("#length_asphalt_before").val()) + parseFloat($("#length_sidewalk_before").val());
        console.log(total);
        total = Math.round(total * 100) / 100;
        $("#length_total_before").val(total);
    }

    $(".touchspinC").TouchSpin({
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