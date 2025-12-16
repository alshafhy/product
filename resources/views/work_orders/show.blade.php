@extends('layouts.app')

@section('title', __('models/workOrders.plural_'.$mode))

@section('breadcrumbs', __('models/workOrders.parent_menu_'.$mode))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> @lang('crud.show') - {{  __('models/workOrders.singular') }} </h4>
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrders'.ucfirst($mode),'action_name' => 'show']) --}}
                <x-form-toolbar :screenname="'workOrders'.ucfirst($mode)" actionname='show' :key="$workOrder->id"></x-form-toolbar>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.show_fields')
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
    @if($workOrder->current_department_id  ==  3)
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
                <h4 class="card-title">التصاريح المرتبطة بأمر العمل </h4>
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
                <h4 class="card-title">الملفات المؤرشفة بأمر العمل </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-attachment.file_list :model="get_class($workOrder)" :id="$workOrder->id" :options="['display'=>['type'=>true,'action'=>true],'action'=>['view'=>false,'download'=>true,'delete'=>false]]"></x-attachment.file_list>
                </div>
            </div>
        </div>
    </div>
    @if($workOrder->work_orders_type_id ==  3 || $workOrder->is_emergency_mission)
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
    @endif

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">سجل التعديلات على أمر العمل </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders.details.show.workOrderHistory')
                </div>
            </div>
        </div>
    </div>
@endsection
