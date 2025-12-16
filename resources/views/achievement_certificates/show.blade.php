@extends('layouts.app')

@section('title', __('models/achievementCertificates.plural'))

@section('breadcrumbs', __('models/achievementCertificates.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title">{{  __('models/achievementCertificates.plural') }}  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'achievementCertificates','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row m-1 p-0">
                    <div class="col-md-3 bold">{{__('models/workOrders.singular')}}</div>
                    <div class="col-md-3">{{$achievementCertificate->workOrder->work_order_number}}</div>
                    <div class="col-md-3 bold">{{__('models/achievementCertificates.fields.cert_date')}}</div>
                    <div class="col-md-3">{{$achievementCertificate->cert_date->toDateString()}}</div>
                </div>
                <div class="row m-1 p-0">
                    <div class="col-md-3 bold">{{__('models/achievementCertificates.fields.status')}}</div>
                    <div class="col-md-3"><span class="badge rounded-pill {{ $status['class'] }}">{{ $status['title'] }}</span></div>
                    <div class="col-md-3 bold">{{__('models/workOrders.fields.received_date')}}</div>
                    <div class="col-md-3">{{$achievementCertificate->workOrder->received_date->toDateString()}}</div>
                </div>
                <div class="row m-1 p-0">
                    <div class="col-md-3 bold">{{__('models/workOrders.fields.total_work_period')}}</div>
                    <div class="col-md-3">{{$achievementCertificate->workOrder->total_work_period}}</div>
                    <div class="col-md-3 bold">{{__('models/achievementCertificates.fields.notes')}}</div>
                    <div class="col-md-3">{{$achievementCertificate->notes}}</div>
                </div>
                <div class="row m-1 p-0">
                    <div class="col-md-3 bold">{{__('models/achievementCertificates.fields.amount')}}</div>
                    <div class="col-md-3">{{$achievementCertificate->amount}}</div>
                    <div class="col-md-3 bold">{{__('models/achievementCertificates.fields.fines_amount')}}</div>
                    <div class="col-md-3">{{$achievementCertificate->fines_amount}}</div>
                </div>
                <div class="row m-1 p-0">
                    <div class="col-md-3 bold">{{__('models/achievementCertificates.fields.net_amount')}}</div>
                    <div class="col-md-3">{{$achievementCertificate->net_amount}}</div>
                    <div class="col-md-3 bold">{{__('models/achievementCertificates.fields.fines_amount_percentage')}}</div>
                    <div class="col-md-3">{{number_format((floatval($achievementCertificate->fines_amount)/floatval($achievementCertificate->amount))*100,2)}}%</div>
                </div>
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
            </div>
        </div>
    </div>
@endsection
