<!-- Id Field -->
<div class="col-sm-6">
    <strong>{!! Form::label('id', __('models/baladies.fields.id').':') !!}</strong>
    <p>{{ $balady->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-6">
    <strong>{!! Form::label('name', __('models/baladies.fields.name').':') !!}</strong>
    <p>{{ $balady->name }}</p>
</div>

<!-- City Id Field -->
<div class="col-sm-6">
    <strong>{!! Form::label('city_id', __('models/baladies.fields.city_id').':') !!}</strong>
    <p>{{ $balady->city->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    <strong>{!! Form::label('created_at', __('models/baladies.fields.created_at').':') !!}</strong>
    <p>{{ $balady->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    <strong>{!! Form::label('updated_at', __('models/baladies.fields.updated_at').':') !!}</strong>
    <p>{{ $balady->updated_at }}</p>
</div>

