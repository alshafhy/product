<?php

namespace App\View\Components\Report\WorkOrders;

use Closure;
use App\Models\Employee;
use App\Models\WorkType;
use App\Models\Consultant;
use App\Models\Contractor;
use Illuminate\View\Component;
use App\Models\WorkOrdersProject;
use App\Enums\WorkOrderStatusEnum;
use Illuminate\Contracts\View\View;
use App\Models\ElectricityDepartment;
use App\Services\WorkOrders\WorkOrderService;

class WorkOrderFilter extends Component
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
        $consultants = $this->handleFilterListArray(Consultant::pluck('name', 'id')->prepend("اختر","")->toArray());
        $workOrdersProject = $this->handleFilterListArray(WorkOrdersProject::pluck('name', 'id')->prepend("اختر","")->toArray());
        $workTypes = WorkType::all()->pluck('full_name', 'id')->prepend("اختر", "")->toArray();
        $workTypes = $this->handleFilterListArray($workTypes);
        $drilling_worker = Contractor::pluck('company_name', 'company_name')->union(Employee::pluck('name', 'name'))->prepend("اختر", "")->toArray();
        $myArray = WorkOrderStatusEnum::getOptions();
        $workOrderStatus =$this->workOrderService->getStausFromConfig('work_order_general_status','title',true);
        return view('components.report.work-orders.work-order-filter' ,compact(['consultants','electricityDepartments','workOrderStatus','drilling_worker','workTypes','workOrdersProject']));
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
