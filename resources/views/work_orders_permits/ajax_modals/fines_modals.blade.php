<!-- start add modal  -->
<x-modal mode="add" modal="fine">
    <h2>اضافة الغرامة</h2>
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

        <div class="col-12 col-md-6">
            <x-date-pickr name="issue_date" labelTitle="تاريخ الاصدار"></x-date-pickr>
        </div>

        <div class="col-12">
            {!! Form::label('fine_reason', __('models/workOrdersPermits.fields.fine_reason')) !!}
            {!! Form::textarea('fine_reason', null, ['class' => 'form-control' , 'cols'=>'10' , 'rows'=>'5']) !!}
        </div>

        <div class="col-12">
            {!! Form::label('notes', __('models/workOrdersPermits.fields.notes')) !!}
            {!! Form::textarea('notes', null, ['class' => 'form-control' , 'cols'=>'10' , 'rows'=>'5']) !!}
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success" name="insert" id="insert"><span class="ion ion-ios-send"></span>&nbsp;&nbsp;{{ __('crud.save') }}</button>
        </div>
    </form>
</x-modal>



<!-- start show modal  -->
<x-modal mode="show" modal="fine">
    <h2>عرض الغرامة</h2>
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
        {!! Form::label('issue_date', __('models/workOrdersPermits.fields.issue_date')) !!}
        <span id="issue_date"></span>
    </div>

    <div class="col-12">
        {!! Form::label('fine_reason', __('models/workOrdersPermits.fields.fine_reason')) !!}
        <span id="fine_reason"></span>
    </div>

    <div class="col-12">
        {!! Form::label('notes', __('models/workOrdersPermits.fields.notes')) !!}
        <span id="notes"></span>
    </div>

</x-modal>
  <!-- end show modal  -->


  <!-- start edit modal -->
<x-modal mode="edit" modal="fine">
    <h2>تعديل الغرامة</h2>
    <br/>

    <form method="post" class="row gy-1 gx-2" id="edit_form_test2">
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
            {!! Form::label('issue_date', __('models/workOrdersPermits.fields.issue_date')) !!}
            {!! Form::text('issue_date', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-12">
            {!! Form::label('fine_reason', __('models/workOrdersPermits.fields.fine_reason')) !!}
            {!! Form::textarea('fine_reason', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-12">
            {!! Form::label('notes', __('models/workOrdersPermits.fields.notes')) !!}
            {!! Form::textarea('notes', null, ['class' => 'form-control' , 'cols'=>'10' , 'rows'=>'5']) !!}
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-success" name="update" id="update"><span class="ion ion-ios-send"></span>&nbsp;&nbsp;{{ __('crud.update') }}</button>
        </div>

    </form>
</x-modal>
  <!-- end edit modal  -->
