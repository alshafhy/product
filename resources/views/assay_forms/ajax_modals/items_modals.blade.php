<!-- start add modal  -->
<x-modal mode="add" modal="item">
    <p class="address-subtitle text-center mb-2 pb-75">إضافة الصنف</p>

    <form method="POST" class="row gy-1 gx-2" id="insert_form_test">
        @csrf
        <div class="col-12 col-md-12">
            {{ Form::hidden('_method', 'post') }}
            {{ Form::hidden('assay_form_id', $assayForm->id) }}

            {!! Form::label('item_id', __('models/assayItems.fields.item_id').':') !!}
            {!! Form::select('item_id', $items, null, ['class' => 'select2 form-control']) !!}
        </div>

        <div class="col-12 col-md-6">
            {!! Form::label('spend', __('models/assayItems.fields.spend').':') !!}
            {!! Form::text('spend', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-12 col-md-6">
            {!! Form::label('used', __('models/assayItems.fields.used').':') !!}
            {!! Form::text('used', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success" name="insert" id="insert"><span class="ion ion-ios-send"></span>&nbsp; إضافة</button>
        </div>
    </form>
</x-modal>



<!-- start show modal  -->
<x-modal mode="show" modal="item">
    <p class="address-subtitle text-center mb-2 pb-75">عرض الصنف</p>

    <div class="col-12 col-md-6">
        {!! Form::label('id', 'المعرف') !!}
        <span id="id"></span>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('item_id', __('models/workOrdersPermits.fields.item_id').':') !!}
        <span id="item_name"></span>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('spend', __('models/workOrdersPermits.fields.spend').':') !!}
        <span id="spend"></span>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('used', __('models/workOrdersPermits.fields.used').':') !!}
        <span id="used"></span>
    </div>

    <div class="col-12">
        {!! Form::label('returned', __('models/workOrdersPermits.fields.returned').':') !!}
        <span id="returned"></span>
    </div>

    <div class="col-12">
        {!! Form::label('returned_spend', __('models/workOrdersPermits.fields.returned_spend').':') !!}
        <span id="returned_spend"></span>
    </div>

</x-modal>
  <!-- end show modal  -->


  <!-- start edit modal -->
<x-modal mode="edit" modal="item">
    <p class="address-subtitle text-center mb-2 pb-75">تعديل الصنف</p>
    <form method="post" class="row gy-1 gx-2" id="edit_form_test2">
      @csrf
        <div class="col-12 col-md-12">
            {{ Form::hidden('_method', 'PATCH') }}

            {{ Form::hidden('id', '' , array('id' => 'detail_id')) }}

            {!! Form::label('item_id', __('models/assayItems.fields.item_id').':') !!}
            {!! Form::select('item_id', $items, null, ['class' => 'select2 form-control']) !!}
        </div>

        <div class="col-12 col-md-6">
            {!! Form::label('spend', __('models/assayItems.fields.spend').':') !!}
            {!! Form::text('spend', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-12 col-md-6">
            {!! Form::label('used', __('models/assayItems.fields.used').':') !!}
            {!! Form::text('used', null, ['class' => 'form-control']) !!}
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-success" name="update" id="update"><span class="ion ion-ios-send"></span>&nbsp;&nbsp;تحديث</button>
        </div>

    </form>
</x-modal>
  <!-- end edit modal  -->
<script>
    $(document).ready(function() {
        $("#item_id").select2({
            dropdownParent: "#add_item_modal"
        });
    });
</script>
