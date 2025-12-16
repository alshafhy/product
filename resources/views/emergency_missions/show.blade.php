@extends('layouts.app')

@section('title', __('models/emergencyMissions.plural'))

@section('breadcrumbs', __('models/emergencyMissions.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/emergencyMissions.plural') }} - @lang('crud.show')  </h4>
                <x-form-toolbar :screenname="'emergencyMissions'" actionname='show' :key="$workOrder->id"></x-form-toolbar>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('emergency_missions.show_fields')
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">سجل الملاحظات </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.edit.notes_tab')
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">معلومات المسح على الطبيعة </h4>
            </div>
            <div class="card-body">
                @include('work_orders.details.show.scan')
            </div>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">معلومات التنفيذ الفعلى </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.show.actual')
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">الموقع على الخريطة </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.show.map')
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">بيان الاعمال الكهربائية </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.show.electric')
                </div>
            </div>
        </div>
    </div>

    @if($workOrder->electricity_tower && (
        $workOrder->electricity_tower->tower10||
        $workOrder->electricity_tower->tower13||
        $workOrder->electricity_tower->converter||
        $workOrder->electricity_tower->shadad||
        $workOrder->electricity_tower->grid_high_voltage||
        $workOrder->electricity_tower->grid_low_voltage
        ))
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">بيان أعمل الهوائى </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.show.tower')
                </div>
            </div>
        </div>
    </div>
    @endif

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">التصاريح المرتبطة بالمهمة </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.show.permit')
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">الملفات المؤرشفة على المهمه </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-attachment.file_list :model="get_class($workOrder)" :id="$workOrder->id" :options="['display'=>['type'=>true,'action'=>true],'action'=>['view'=>false,'download'=>true,'delete'=>false]]"></x-attachment.file_list>
                </div>
            </div>
        </div>
    </div>
    {{-- @if($workOrder->work_orders_type_id ==  3 || $workOrder->is_emergency_mission)
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">جدول بالمهمات المرتبطه</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.show.workOrders')
                </div>
            </div>
        </div>
    </div>
    @endif --}}

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">سجل التعديلات على المهمة </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.show.workOrderHistory')
                </div>
            </div>
        </div>
    </div>
@endsection
