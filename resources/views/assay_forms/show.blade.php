@extends('layouts.app')

@section('title', __('models/assayForms.plural'))

@section('breadcrumbs', __('models/assayForms.plural'))

@section('content')
    @php
        $assay_form_status = config("const.assay_form");
    @endphp
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/assayForms.plural') }} - @lang('crud.show')  </h4>
                <a class="btn btn-primary float-end" href="{{route("assayForms.printAssay",['id'=>$assayForm->id])}}">
                    طباعه المقايسة
                </a>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'assayForms','action_name' => 'show'])
                
            </div>
            <div class="card-body">
                <div class="row">
                   @include('work_orders.details.edit.fixed_info',['workOrder' => $assayForm->workOrder])
                </div>
                <div class="row m-1">
                    <div class="col-md-4">
                        <span class="fw-bolder text-primary">الحالة</span>:
                        @if(isset($assay_form_status[$assayForm->status]))
                            <span class="badge rounded-pill {{$assay_form_status[$assayForm->status]['class']}}">{{$assay_form_status[$assayForm->status]['title']}}</span>
                        @else
                            {{$assayForm->status}}
                        @endif
                    </div>
                    <div class="col-md-4">
                        <span class="fw-bolder text-primary">إجمالي المقايسة</span>:
                        {{number_format($assayForm->amount,2)}}
                    </div>
                    <div class="col-md-4">
                        <span class="fw-bolder text-primary">تاريخ الانشاء</span>:
                        {{$assayForm->created_at}}
                    </div>
                </div>
                <div class="row m-1">
                    <div class="col-md-4">
                        <span class="fw-bolder text-primary">ملاحظات</span>:
                        {{$assayForm->notes}}
                    </div>
                </div>
                <div class="row p-1">
                    <div class="col-md-6">
                        @include('assay_forms.show.items')
                    </div>
                    <div class="col-md-6">
                        @include('assay_forms.show.services')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
