<div>
    {!! Form::label($name, $labelTitle.':') !!}
    {!! Form::text($name, $dateValue, ['class' => 'form-control flatpickr-basic','id'=>$name ,'placeholder'=>$placeholder,'style'=>'width: 75%;', 'autocomplete'=>'off']) !!}
</div>
