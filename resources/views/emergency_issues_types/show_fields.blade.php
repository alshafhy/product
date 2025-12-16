<!-- Name Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('name', __('models/emergencyIssuesTypes.fields.name').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $emergencyIssuesType->name }}</p>
        </div>
    </div>
</div>

<!-- Description Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('description', __('models/emergencyIssuesTypes.fields.description').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $emergencyIssuesType->description }}</p>
        </div>
    </div>
</div>

<!-- Created At Field -->
{{-- <div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('created_at', __('models/emergencyIssuesTypes.fields.created_at').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $emergencyIssuesType->created_at }}</p>
        </div>
    </div>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('updated_at', __('models/emergencyIssuesTypes.fields.updated_at').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $emergencyIssuesType->updated_at }}</p>
        </div>
    </div>
</div> --}}

