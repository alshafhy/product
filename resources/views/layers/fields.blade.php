<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/layers.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
@php
$count = \App\Models\Layer::query()->count()+1;
$order_list = [];
for ($i=1;$i<=$count;$i++){
    $order_list[$i] = $i;
}
@endphp
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', __('models/layers.fields.order').':') !!}
    {!! Form::select('order',$order_list, null, ['class' => 'form-control']) !!}
</div>

<!-- Is Final Field -->
<div class="form-group col-sm-6">
    <x-custom-switch name="is_final" :labelTitle="__('models/layers.fields.is_final')"></x-custom-switch>
</div>
