<div>
    {!! Form::label($name, $labelTitle.':') !!}
    {!! Form::hidden($name, 0) !!}
    {!! Form::checkbox($name, 1, $isCheckedByDefault,  ['data-bootstrap-switch']) !!}
</div>