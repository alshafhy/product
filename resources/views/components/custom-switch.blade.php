<label class="form-check-label mb-50" for="{{$name}}">{{$labelTitle}}</label>
<div class="form-check form-switch form-check-primary">
    {!! Form::hidden($name, 0) !!}
    {!! Form::checkbox($name, '1', $isCheckedByDefault, ['class' => 'form-check-input','id'=>$name]) !!}
    <label class="form-check-label" for="{{$name}}">
    <span class="switch-icon-left"><i data-feather="check"></i></span>
    <span class="switch-icon-right"><i data-feather="x"></i></span>
    </label>
</div>