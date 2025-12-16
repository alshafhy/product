<div>
    {!! Form::label($name, $labelTitle.':') !!}   
    <div class="input-group" >
        @if ($defaultValue)
        {!! Form::number($name, $defaultValue, ['class' => 'touchspin input-group-lg','id' => $name]) !!}
        @else
        {!! Form::number($name, null, ['class' => 'touchspin input-group-lg','id' => $name]) !!}
        @endif
   
    </div>
</div>