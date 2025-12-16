<?php
        
        $departments = config('initiation-data.departments');
        function getCorerectStatus($type,$status)  {
            $work_order_status= config("const.work_order_general_status");
            $work_order_drilling_status= config("const.work_order_drilling_status");
            $work_order_electricity_status= config("const.work_order_electricity_status");
            
            if($type == 1){
                return $work_order_status[$status]['title'] ?? "-";
            }elseif($type == 2){
                return $work_order_status[$status]['title'] ?? "-";
            }elseif ($type==3) {
                
            }elseif ($type==4) {
                return $work_order_drilling_status[$status]['title'] ?? "-";
            }elseif ($type==5) {
                return $work_order_electricity_status[$status]['title'] ?? "-"; 
            }
           
            return "-";
        }
?>
<div class="row m-1">
    <div class="table-responsive">
        <table class="table table-bordered" id="permits-table">
            <thead>
            <tr>
                <th>{{__('models/workOrderHistorys.fields.description')}}</th>
                <th>{{__('models/workOrderHistorys.fields.note')}}</th>
                <th>{{__('models/workOrderHistorys.fields.name')}}</th>
                <th>{{__('models/workOrderHistorys.fields.old_status')}}</th>
                <th>{{__('models/workOrderHistorys.fields.new_status')}}</th>
                <th>{{__('models/workOrderHistorys.fields.old_department')}}</th>
                <th>{{__('models/workOrderHistorys.fields.new_department')}}</th>
                <th>{{__('models/workOrderHistorys.fields.updated_at')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($workOrderHistory as $workOrderHistory)
                <tr>
                    <td>{{$workOrderHistory->description}}</td>
                    <td>{{$workOrderHistory->note}}</td>
                    <td>{{$workOrderHistory->user->name}}</td>
                    <td>{{ getCorerectStatus($workOrderHistory->type,$workOrderHistory->old_status)}} </td>
                    <td>{{ getCorerectStatus($workOrderHistory->type,$workOrderHistory->new_status) }} </td>
                    <td>{{ isset($departments[$workOrderHistory->old_department]['name']) ? $departments[$workOrderHistory->old_department]['name']: '-' }} </td>
                    <td>{{ isset($departments[$workOrderHistory->new_department]['name']) ? $departments[$workOrderHistory->new_department]['name']: '-' }} </td>
                    <td>{{$workOrderHistory->updated_at->format('Y/m/d h:m:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color: red; ">لا توجد تعديلات</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
