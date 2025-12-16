<!-- Version Number Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('version_number', __('models/systemReleases.fields.version_number').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemRelease->version_number }}</p>
        </div>
    </div>
</div>

<!-- Release Date Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('release_date', __('models/systemReleases.fields.release_date').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemRelease->release_date }}</p>
        </div>
    </div>
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('created_at', __('models/systemReleases.fields.created_at').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemRelease->created_at }}</p>
        </div>
    </div>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">
                {!! Form::label('updated_at', __('models/systemReleases.fields.updated_at').':') !!}
                </div>
        <div class="col-sm-9 ">
            <p>{{ $systemRelease->updated_at }}</p>
        </div>
    </div>
</div>

