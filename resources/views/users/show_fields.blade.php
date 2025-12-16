<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/users.fields.id').':') !!}
    <p>{{ $user->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Username Field -->
<div class="col-sm-12">
    {!! Form::label('username', __('models/users.fields.username').':') !!}
    <p>{{ $user->username }}</p>
</div>

