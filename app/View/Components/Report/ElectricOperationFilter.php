<?php

namespace App\View\Components\Report;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\WorkType;

use App\Models\ElectricityDepartment;
use App\Services\WorkOrders\WorkOrderService;

class ElectricOperationFilter extends Component
{
  

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        // $workOrdersType = $this->handleFilterListArray(WorkType::pluck('name', 'id')->prepend("اختر","")->toArray());
        $m = WorkType::pluck('name', 'id')->prepend("اختر","")->toArray();
        // dd($m);
        // $this->workOrdersType=$m;
        return view('components.report.electric-operation-filter')->with('m',$m);
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
