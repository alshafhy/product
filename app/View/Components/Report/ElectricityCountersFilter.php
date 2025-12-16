<?php

namespace App\View\Components\Report;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\WorkType;
use App\Enums\WorkOrderStatusEnum;
use App\Models\ElectricityDepartment;
use App\Services\WorkOrders\WorkOrderService;

class ElectricityCountersFilter extends Component
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
        $workOrdersType = $this->handleFilterListArray(WorkType::pluck('name', 'id')->prepend("اختر","")->toArray());
        return view('components.report.electricity-counters-filter',compact('workOrdersType'));
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
