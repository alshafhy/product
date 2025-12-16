<?php

namespace App\View\Components\Report;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Consultant;
use App\Enums\WorkOrderStatusEnum;
use App\Models\ElectricityDepartment;
use App\Services\WorkOrders\WorkOrderService;

class FinishedElectricityFilter extends Component
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
        return view('components.report.finished-electricity-filter');
    }


}
