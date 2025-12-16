<?php

namespace App\View\Components\Report;

use Closure;
use App\Models\Consultant;
use Illuminate\View\Component;
use App\Models\WorkType;
use App\Enums\WorkOrderStatusEnum;
use Illuminate\Contracts\View\View;
use App\Models\ElectricityDepartment;
use App\Services\WorkOrders\WorkOrderService;


class ElectricTowerOrdersFilter extends Component
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
        $electricityDepartments = $this->handleFilterListArray(ElectricityDepartment::pluck('name', 'id')->prepend("اختر","")->toArray());
        $workOrdersType = WorkType::all()->map->only('id', 'full_name')->pluck('full_name', 'id')->prepend("اختر","");
        $consultants = Consultant::pluck('name', 'id')->prepend("اختر","");
        $myArray = WorkOrderStatusEnum::getOptions();
        $workOrderStatus =$this->workOrderService->getStausFromConfig('work_order_general_status','title',true);
        return view('components.report.electric-tower-orders-filter' ,compact(['workOrdersType','consultants','electricityDepartments','workOrderStatus']));
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
