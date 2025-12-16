<div>
    {{-- 'onchange'=>"chngStatus(this.value);" --}}
    {!! Form::label($name, $labelTitle.':') !!}  
    {{-- {!! Form::text('electrical_stations_type_id', null, ['class' => 'form-control']) !!} --}}
    {!! Form::select($name, $options, $defaultValue, ['class' => $class, 'id' => $name]) !!}
</div>
