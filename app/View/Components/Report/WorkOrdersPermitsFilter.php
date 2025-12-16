<?php

namespace App\View\Components\Report;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Consultant;
use App\Enums\WorkOrderStatusEnum;
use App\Models\ElectricityDepartment;
use App\Services\WorkOrders\WorkOrderService;

class WorkOrdersPermitsFilter extends Component
{
    private $workOrderService;
    /**
     * Create a new component instance.
     */
    public function __construct(WorkOrderService $workOrderService)
    {
        $this->workOrderService = $workOrderService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $myArray = WorkOrderStatusEnum::getOptions();
        $workOrdersPermits =$this->workOrderService->getStausFromConfig('work_order_permit_status','title',true);
        $workOrderStatus =$this->workOrderService->getStausFromConfig('work_order_general_status','title',true);
        return view('components.report.work-orders-permits-filter' ,compact(['workOrderStatus','workOrdersPermits']));

    }
    function handleFilterListArray($myArray)  {
        return $result = array_combine(
            array_map(function ($key, $value) {
                if($value !='اختر')
                return $key ."||". $value;
            }, array_keys($myArray), $myArray),
            array_values($myArray)
        );
    }
}
