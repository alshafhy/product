<!-- System Release Id Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('system_release_id', __('models/systemReleasesFeatures.fields.system_release_id').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemReleasesFeature->system_release_id }}</p>
        </div>
    </div>
</div>

<!-- Title Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('title', __('models/systemReleasesFeatures.fields.title').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemReleasesFeature->title }}</p>
        </div>
    </div>
</div>

<!-- Description Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('description', __('models/systemReleasesFeatures.fields.description').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemReleasesFeature->description }}</p>
        </div>
    </div>
</div>

<!-- Feature Order Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('feature_order', __('models/systemReleasesFeatures.fields.feature_order').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemReleasesFeature->feature_order }}</p>
        </div>
    </div>
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('created_at', __('models/systemReleasesFeatures.fields.created_at').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemReleasesFeature->created_at }}</p>
        </div>
    </div>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('updated_at', __('models/systemReleasesFeatures.fields.updated_at').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemReleasesFeature->updated_at }}</p>
        </div>
    </div>
</div>

