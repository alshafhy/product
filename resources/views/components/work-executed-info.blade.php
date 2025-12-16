<div>
    <div class="row">
        <span class="fw-bolder">نوع المنفذ - {{$labelTitle}}</span>
    </div>
    <div class="row custom-options-checkable g-1">
        <div class="col-md-2">
            <input
                class="custom-option-item-check"
                type="radio"
                name="{{$workerTypeFieldName}}"
                id="{{$workerTypeFieldName}}_employee"
                value="employee"
                @if(!isset($executedData->$workerTypeFieldName) || $executedData->$workerTypeFieldName =='employee')
                checked
                @endif
            />
            <label class="custom-option-item p-1" for="{{$workerTypeFieldName}}_employee" style="text-align: center;">
              {{-- <span class="d-flex justify-content-between flex-wrap mb-50"> --}}
                <span class="d-flex justify-content-md-center flex-wrap mb-50">
                {{-- <span class="fw-bolder">نوع المنفذ - {{$labelTitle}}</span> --}}
                <span class="fw-bolder">مراقب</span>
              </span>
            </label>
        </div>

        <div class="col-md-2">
            <input
                class="custom-option-item-check"
                type="radio"
                name="{{$workerTypeFieldName}}"
                id="{{$workerTypeFieldName}}_contractor"
                value="contractor"
            @if(isset($executedData->$workerTypeFieldName) && $executedData->$workerTypeFieldName =='contractor')
                checked
            @endif
            />
            <label class="custom-option-item p-1" for="{{$workerTypeFieldName}}_contractor">
              {{-- <span class="d-flex justify-content-between flex-wrap mb-50"> --}}
                <span class="d-flex justify-content-md-center flex-wrap mb-50">
                {{-- <span class="fw-bolder">نوع المنفذ - {{$labelTitle}}</span> --}}
                <span class="fw-bolder">مقاول</span>
              </span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6" id="{{$employeeFieldName}}_employee_selector">
            {!! Form::label($employeeFieldName, 'كود / اسم المراقب') !!}
            {!! Form::select($employeeFieldName, $employees,$executedData->$employeeFieldName ?? null, ['class' => 'select2 form-select form-control']) !!}
        </div>
        <div class="form-group col-sm-6" id="{{$contractorFieldName}}_contractor_selector">
            {!! Form::label($contractorFieldName, 'كود / اسم المقاول') !!}
            {!! Form::select($contractorFieldName, $contractors,$executedData->$contractorFieldName ?? null, ['class' => 'select2 form-select form-control']) !!}
        </div>
    </div>
    @if ($completeDateFieldName)
        <div class="row">
            <div class="form-group col-sm-6">
                <x-date-pickr name="{{$completeDateFieldName}}" labelTitle="تاريخ التنفيذ" dateValue="{{$executedData->$completeDateFieldName ?? null }}"></x-date-pickr>
            </div>
        </div>
    @endif
   
</div>

@push('page-script')
<script>
$('input[name={{$workerTypeFieldName}}]').on('click',function (e) {
    toggleSelector_{{$workerTypeFieldName}}($(this).val() );
});

function toggleSelector_{{$workerTypeFieldName}} (val) {
    if(val === 'contractor'){
        $("#{{$contractorFieldName}}_contractor_selector").show();
        $("#{{$employeeFieldName}}_employee_selector").hide();
        $("#{{$employeeFieldName}}").val(null).trigger('change');
    }else{
        $("#{{$contractorFieldName}}_contractor_selector").hide();
        $("#{{$employeeFieldName}}_employee_selector").show();
        $("#{{$contractorFieldName}}").val(null).trigger('change');
    }
}
toggleSelector_{{$workerTypeFieldName}} ("{{$executedData->$workerTypeFieldName}}") 


   
</script>
@endpush