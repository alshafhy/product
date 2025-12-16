<!-- start add modal  -->
<x-modal mode="add" modal="services">
    <p class="address-subtitle text-center mb-2 pb-75">إضافة بنود الاعمال</p>

    <form method="POST" class="row gy-1 gx-2" id="insert_form_test">
        @csrf
        <div class="col-12 col-md-12">
            {{ Form::hidden('_method', 'post') }}
            {{ Form::hidden('assay_form_id', $assayForm->id) }}

            {!! Form::label('service_id', __('models/assayServices.fields.service_id').':') !!}
            {!! Form::select('service_id', $services, null, ['class' => 'select2 form-control']) !!}
        </div>

        <div class="col-12 col-md-6">
            {!! Form::label('quantity',  __('models/assayServices.fields.quantity').':') !!}
            {!! Form::number('quantity', null, ['class' => 'form-control', 'id'=>'quantity', 'step'=>'.01']) !!}
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success" name="insert" id="insert"><span class="ion ion-ios-send"></span>&nbsp;&nbsp;حفظ</button>
        </div>
    </form>
</x-modal>



<!-- start show modal  -->
<x-modal mode="show" modal="services">
    <p class="address-subtitle text-center mb-2 pb-75">عرض بنود الاعمال</p>

    <div class="col-12 col-md-6">
        {!! Form::label('id', 'المعرف') !!}
        <span id="id"></span>
    </div>

    <div class="col-12 col-md-12">
        {!! Form::label('service_id', __('models/assayServices.fields.service_id').':') !!}
        <span id="service_name"></span>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('quantity', __('models/assayServices.fields.quantity').':') !!}
        <span id="quantity"></span>
    </div>


</x-modal>
  <!-- end show modal  -->


  <!-- start edit modal -->
<x-modal mode="edit" modal="services">
    <p class="address-subtitle text-center mb-2 pb-75">تعديل بنود الاعمال</p>
    <form method="post" class="row gy-1 gx-2" id="edit_form_test">
      @csrf
        <div class="col-12 col-md-12">
            {{ Form::hidden('_method', 'PATCH') }}

            {{ Form::hidden('id', '' , array('id' => 'detail_id')) }}
            
            {!! Form::label('service_id', __('models/assayServices.fields.service_id').':') !!}
            {!! Form::select('service_id', $services, null, ['class' => 'select2 form-control']) !!}
        </div>

        <div class="col-12 col-md-6">
            {!! Form::label('quantity', __('models/assayServices.fields.quantity').':') !!}
            {!! Form::number('quantity', null, ['class' => 'form-control', 'step'=>'.01']) !!}
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-success" name="update" id="update"><span class="ion ion-ios-send"></span>&nbsp;&nbsp;تحديث</button>
        </div>

    </form>
</x-modal>
  <!-- end edit modal  -->
<script>
    $(document).ready(function() {
        $("#service_id").select2({
            dropdownParent: "#add_services_modal"
        });
    });
</script>
