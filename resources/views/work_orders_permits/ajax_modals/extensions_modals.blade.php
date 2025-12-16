<!-- start add modal  -->
<x-modal mode="add" modal="extension">
    <h2>اضافة التمديد</h2>
    <br/>

    <form method="POST" class="row gy-1 gx-2" id="insert_form_test">
        @csrf
        <div class="col-12 col-md-6">
            {{ Form::hidden('_method', 'post') }}
            {{ Form::hidden('work_orders_permit_id', $workOrdersPermit->id) }}

            {!! Form::label('sadad_number', __('models/workOrdersPermits.fields.sadad_number').':') !!}
            {!! Form::text('sadad_number', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-12 col-md-6">
            {!! Form::label('amount', __('models/workOrdersPermits.fields.amount')) !!}
            {!! Form::text('amount', null, ['class' => 'form-control']) !!}
        </div>

        {{-- <div class="col-12 col-md-6">
            <x-date-pickr name="issue_date" labelTitle="تاريخ الاصدار"></x-date-pickr>
        </div> --}}

      <!-- Period Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('period', __('models/workOrdersPermits.fields.ext_period').':') !!}
            <div class="input-group" >
                <input name="period" type="number" class="touchspin input-group-lg" value="30" />
            </div>
        </div>

        <div class="col-12">
            {!! Form::label('notes', __('models/workOrdersPermits.fields.notes')) !!}
            {!! Form::textarea('notes', null, ['class' => 'form-control' , 'cols'=>'10' , 'rows'=>'5']) !!}
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success" name="insert" id="insert"><span class="ion ion-ios-send"></span>&nbsp;&nbsp;{{ __('crud.save') }} </button>
        </div>
    </form>
</x-modal>



<!-- start show modal  -->
<x-modal mode="show" modal="extension">
    <h2>عرض التمديد</h2>
    <br/>

    <div class="col-12 col-md-6">
        {!! Form::label('id', 'المعرف') !!}
        <span id="id"></span>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('sadad_number', __('models/workOrdersPermits.fields.sadad_number').':') !!}
        <span id="sadad_number"></span>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('amount', __('models/workOrdersPermits.fields.amount')) !!}
        <span id="amount"></span>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('from_date', __('models/workOrdersPermits.fields.start_date')) !!}
        <span id="from_date"></span>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('to_date', __('models/workOrdersPermits.fields.end_date')) !!}
        <span id="to_date"></span>
    </div>

    <div class="col-12">
        {!! Form::label('notes', __('models/workOrdersPermits.fields.notes')) !!}
        <span id="notes"></span>
    </div>

</x-modal>
  <!-- end show modal  -->


  <!-- start edit modal -->
<x-modal mode="edit" modal="extension">
    <div id="extension_edit_errors" class="error" style="padding: 10px"></div>
    <h2>تعديل التمديد</h2>
    <br/>
    <form method="post" class="row gy-1 gx-2" id="edit_form_test">
      @csrf
        <div class="col-12 col-md-6">
            {{ Form::hidden('_method', 'PATCH') }}

            {{ Form::hidden('id', '' , array('id' => 'detail_id')) }}
            
            {!! Form::label('sadad_number', __('models/workOrdersPermits.fields.sadad_number').':') !!}
            {!! Form::text('sadad_number', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-12 col-md-6">
            {!! Form::label('amount', __('models/workOrdersPermits.fields.amount')) !!}
            {!! Form::text('amount', null, ['class' => 'form-control']) !!}
        </div>

       
        <div class="col-12 col-md-6">
                <x-date-pickr name="from_date" labelTitle="تاريخ البداية"></x-date-pickr>
        </div> 

        <div class="col-12 col-md-6">
            <x-date-pickr name="to_date" labelTitle="تاريخ النهاية"></x-date-pickr>
        </div> 

        <div class="form-group col-sm-6">
            {!! Form::label('period', __('models/workOrdersPermits.fields.ext_period').':') !!}
            <div class="input-group" >
                <input name="period" type="number" class="touchspin input-group-lg" value="0" />
            </div>
        </div>

        <div class="col-12">
            {!! Form::label('notes', __('models/workOrdersPermits.fields.notes')) !!}
            {!! Form::textarea('notes', null, ['class' => 'form-control' , 'cols'=>'10' , 'rows'=>'5']) !!}
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-success" name="update" id="update"><span class="ion ion-ios-send"></span>&nbsp;&nbsp;{{ __('crud.update') }} </button>
        </div>

    </form>
</x-modal>
  <!-- end edit modal  -->
