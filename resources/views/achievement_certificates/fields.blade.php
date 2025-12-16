@if(Route::currentRouteName() == 'achievementCertificates.edit')
    @include('work_orders.details.edit.fixed_info' ,["workOrder"=>$achievementCertificate->workOrder])
    {{ Form::hidden('work_order_id', $achievementCertificate->work_order_id , ['id' => 'work_order_id']) }}
@else
<div class="form-group col-sm-6">
    <x-select2 name="work_order_id" :options="$workOrders" :labelTitle="__('models/workOrders.singular')"></x-select2>
</div>
@endif
<!-- Cert Date Field -->
<div class="form-group col-sm-6">
    <x-date-pickr name="cert_date" :labelTitle="__('models/achievementCertificates.fields.cert_date')"></x-date-pickr>
</div>

@if(Route::currentRouteName() == 'achievementCertificates.edit')
<!-- Amount Field-->
<div class="form-group col-sm-3">
    {!! Form::label('amount', __('models/achievementCertificates.fields.amount').':') !!}
    {!! Form::text('amount', null, ['class' => 'form-control','readonly'=>'readonly']) !!}
</div>
@endif

<!-- Fines Amount Field -->
<div class="form-group col-sm-3">
    {!! Form::label('fines_amount', __('models/achievementCertificates.fields.fines_amount').':') !!}
    {!! Form::text('fines_amount', null, ['class' => 'form-control']) !!}
</div>

@if(Route::currentRouteName() == 'achievementCertificates.edit')
<!-- net_amount Field-->
<div class="form-group col-sm-3">
    {!! Form::label('net_amount', __('models/achievementCertificates.fields.net_amount').':') !!}
    {!! Form::text('net_amount', null, ['class' => 'form-control','readonly'=>'readonly']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('final_amount', __('models/achievementCertificates.fields.final_amount').':') !!}
    {!! Form::text('final_amount', null, ['class' => 'form-control']) !!}
</div>
@endif

<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notes', __('models/achievementCertificates.fields.notes').':') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
</div>
@if(Route::currentRouteName() == 'achievementCertificates.edit')
<div class="row m-1 p-0">
    <table class="table">
        <thead>
        <tr>
            <th>@lang('models/assayServices.fields.code')</th>
            <th>@lang('models/workOrderServices.fields.name')</th>
            <th>@lang('models/workOrderServices.fields.price')</th>
            <th>@lang('models/assayServices.fields.quantity')</th>
            <th>@lang('models/assayForms.fields.amount')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($assayForm->assayService as $assayService)
            <tr>
                <td>{{$assayService->service->code}}</td>
                <td>{{$assayService->service->name}}</td>
                <td>{{$assayService->service->price}}</td>
                <td>{{$assayService->quantity}}</td>
                <td>{{$assayService->price}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$assayForm->assayService->sum('price')}}</td>
        </tr>
        </tfoot>
    </table>
</div>
@endif

