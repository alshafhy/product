<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/achievementCertificates.fields.id').':') !!}
    <p>{{ $achievementCertificate->id }}</p>
</div>

<!-- Work Order Id Field -->
<div class="col-sm-12">
    {!! Form::label('work_order_id', __('models/achievementCertificates.fields.work_order_id').':') !!}
    <p>{{ $achievementCertificate->work_order_id }}</p>
</div>

<!-- Cert Date Field -->
<div class="col-sm-12">
    {!! Form::label('cert_date', __('models/achievementCertificates.fields.cert_date').':') !!}
    <p>{{ $achievementCertificate->cert_date }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/achievementCertificates.fields.status').':') !!}
    <p>{{ $achievementCertificate->status }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', __('models/achievementCertificates.fields.amount').':') !!}
    <p>{{ $achievementCertificate->amount }}</p>
</div>

<!-- Fines Amount Field -->
<div class="col-sm-12">
    {!! Form::label('fines_amount', __('models/achievementCertificates.fields.fines_amount').':') !!}
    <p>{{ $achievementCertificate->fines_amount }}</p>
</div>

<!-- Net Amount Field -->
<div class="col-sm-12">
    {!! Form::label('net_amount', __('models/achievementCertificates.fields.net_amount').':') !!}
    <p>{{ $achievementCertificate->net_amount }}</p>
</div>

<!-- Notes Field -->
<div class="col-sm-12">
    {!! Form::label('notes', __('models/achievementCertificates.fields.notes').':') !!}
    <p>{{ $achievementCertificate->notes }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/achievementCertificates.fields.created_at').':') !!}
    <p>{{ $achievementCertificate->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/achievementCertificates.fields.updated_at').':') !!}
    <p>{{ $achievementCertificate->updated_at }}</p>
</div>

