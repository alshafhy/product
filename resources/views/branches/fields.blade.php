<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/branches.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/branches.fields.city_name').':') !!}
    {!! Form::select('city_id', $cities,null, ['class' => 'select2 form-select form-control','label'=>'ss']) !!}
</div>

<!-- District Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('district_id', __('models/branches.fields.district_id').':') !!}
    {!! Form::text('district_id', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Is Main Branch Field -->
{{-- <div class="form-group col-sm-6">
    <div class="form-check form-check-inline" ><br>
        {!! Form::label('is_main_branch', __('models/branches.fields.is_main_branch').'.', ['class' => '']) !!}
        {!! Form::hidden('is_main_branch', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_main_branch', '1', null, ['class' => 'form-check-input']) !!}
      
       
    </div>
</div> --}}
