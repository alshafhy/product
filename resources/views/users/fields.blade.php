<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', __('models/users.fields.username').':') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    {{-- <x-select2 name="branch_id" :options="$branches" :labelTitle="__('models/users.fields.branch_name')"></x-select2>  --}}
</div>