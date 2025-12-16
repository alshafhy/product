@extends('layouts.app')

@section('title', __('models/financialDues.plural'))

@section('breadcrumbs', __('models/financialDues.plural'))

@section('content')
    @include('flash::message')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($financialDue, ['route' => ['financialDues.update', $financialDue->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/financialDues.plural') }} - @lang('crud.edit') </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'financialDues', 'action_name' => 'edit'])
                <div class="demo-inline-spacing">
                    @if($financialDue->status == \App\Http\Controllers\FinancialDueController::STATUS_NEW)
                        <a class="btn btn-primary float-end"
                            href="{{route("financialDues.approval", ['id' => $financialDue->id])}}">
                            إعتماد المستخلص
                        </a>
                    @endif

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('financial_dues.fields')
                </div>
            </div>

            <div class="card-footer">
                <x-form-submit-buttons screenname="financialDues" cancelroute="financialDues.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}
            <div class="card-body">
                <div class="row">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general"
                                aria-controls="general" role="tab" aria-selected="true"></a>
                        </li>
                    </ul>
                    <div class="tab-content border">
                        <div class="tab-pane active " id="general" aria-labelledby="general-tab" role="tabpanel">

                            {{-- <div class="col-md-4">
                                <span class="fw-bolder text-primary">إجمالي المستخلص</span>:

                                <span
                                    class="fw-bolder text-primary">{{number_format($financialDue->total_final_amount,2)}}</span>
                                ريال سعودى
                            </div> --}}
                            <!-- Needs Drilling Operations Field -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        {{-- <h4
                                            class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-4">
                                            --}}


                                            <div class=" pull-right ">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#add_workOrder_modal">
                                                    اضافة أوامر العمل
                                                </button>
                                            </div>
                                            <br>

                                            {{--
                                        </h4> --}}
                                        <table class="table table-striped table-hover table-responsive">
                                            <tbody id="extensions_table">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('#')}}</th>
                                                        <th>{{__('models/workOrders.fields.work_order_number')}}</th>

                                                        <th>{{__('models/workOrders.fields.work_type_name')}}</th>
                                                        <th>{{__('models/workOrders.fields.received_date')}}</th>
                                                        {{-- <th>{{__('models/workOrders.fields.current_department_name')}}
                                                        </th> --}}
                                                        {{-- <th>{{__('models/workOrders.fields.total_work_period')}}</th>
                                                        --}}
                                                        {{-- <th>{{__('models/assayServices.fields.quantity') }}</th> --}}
                                                        <th>{{__('models/financialDues.fields.amount') }}</th>
                                                        <th>{{__('models/financialDues.fields.fines_amount') }}</th>
                                                        <th>{{__('models/financialDues.fields.net_amount') }}</th>
                                                        <th>{{__('models/financialDues.fields.final_amount') }}</th>
                                                        <th>{{__('models/financialDues.fields.notes') }}</th>
                                                        {{-- <th>{{__('models/workOrders.fields.received_date')}}</th> --}}
                                                        <th>{{('action')}}</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                @if(($financialDue->workOrder))
                                                    @foreach($financialDue->workOrder as $workOrder)
                                                                                            <tr>
                                                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                                                <th scope="row">
                                                                                                    <a href="{{route('workOrders.show', ['workOrder' => $workOrder->id])}}"
                                                                                                        class=''>
                                                                                                        {{ $workOrder->work_order_number }}
                                                                                                    </a>
                                                                                                </th>

                                                                                                <td>{{ $workOrder->workType->code }}</td>
                                                                                                <td>{{ $workOrder->received_date->toDateString() }}</td>
                                                                                                {{-- <td>{{ $workOrder->currentDepartment->name }}</td> --}}
                                                                                                {{-- <td>{{ $workOrder->total_work_period }}</td> --}}
                                                                                                {{-- <td>{{ $workOrder->achievementCertificate->sum('quantity') }}</td>
                                                                                                --}}
                                                                                                <td>{{ $workOrder->achievementCertificate->sum('amount') }}</td>
                                                                                                <td>{{ $workOrder->achievementCertificate->sum('fines_amount') }}</td>
                                                                                                <td>{{ $workOrder->achievementCertificate->sum('net_amount') }}</td>
                                                                                                <td class="text-primary">
                                                                                                    {{ $workOrder->achievementCertificate->sum('final_amount') }}</td>

                                                                                                <td>{{ $workOrder->achievementCertificate->first()->notes}}</td>
                                                                                                <td>
                                                                                                    <div class='btn-group'>
                                                                                                        <a href="{{route('achievementCertificates.show', ['achievementCertificate' => $workOrder->achievementCertificate->first()->id])}}"
                                                                                                            class='btn btn-outline-primary btn-sm'>
                                                                                                            <i data-feather="eye"></i>
                                                                                                        </a>
                                                                                                        <a target="_blank"
                                                                                                            href="{{route('achievementCertificates.edit', ['achievementCertificate' => $workOrder->achievementCertificate->first()->id])}}"
                                                                                                            class='btn btn-outline-primary btn-sm'>
                                                                                                            <i data-feather="edit"></i>
                                                                                                        </a>
                                                                                                        <a href="{{route("financialDues.deleteWorkOrder", [

                                                            'financial_due_id' => $financialDue->id,
                                                            'work_order_id' => $workOrder->id,
                                                        ])}}" class='btn btn-outline-danger btn-sm'>
                                                                                                            <i data-feather="trash"></i>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group col-sm-3 border rounded p-1 text-primary">
                                        <span class="bold">اجمالى المستخلص</span>:
                                        <span
                                            id="total_service_price">{{number_format($financialDue->total_final_amount, 2)}}</span>
                                        ريال سعودى
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- start add modal  -->
    <x-modal mode="add" modal="workOrder">
        <h2>اضافة أمر عمل</h2>
        <br />

        <form method="POST" action="{{route('financialDues.storeWorkOrder', $financialDue->id)}}" class="row gy-1 gx-2"
            id="insert_form_test">
            @csrf

            <div class="col-12 col-md-12">

                {!! Form::label('work_order_ids', __('models/workOrders.fields.work_order_number') . ':') !!}
                {!! Form::select('work_order_ids[]', $workOrders, null, ['class' => 'select2 form-control', 'multiple' => 'multiple']) !!}
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-success" name="save"><span
                        class="ion ion-ios-send"></span>&nbsp;&nbsp;{{ __('crud.save') }} </button>
            </div>
        </form>
    </x-modal>
@endsection