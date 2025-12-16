<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Enums\JobNameEnum;
use App\Models\Contractor;
use Illuminate\View\Component;

class WorkExecutedInfo extends Component
{
    public $workerTypeFieldName;
    public $employeeFieldName;
    public $contractorFieldName;
    public $completeDateFieldName;
    public $labelTitle;
    public $defaultValue;
    public $executedData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employeeFieldName,$contractorFieldName,$workerTypeFieldName,$completeDateFieldName="",$executedData ="",$labelTitle="",$defaultValue=null)
    {
        $this->employeeFieldName=$employeeFieldName;
        $this->contractorFieldName=$contractorFieldName;
        $this->workerTypeFieldName=$workerTypeFieldName;
        $this->completeDateFieldName=$completeDateFieldName;
        $this->executedData=$executedData;
        $this->labelTitle=$labelTitle;
        $this->defaultValue=$defaultValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $contractors = Contractor::pluck('name', 'id')->prepend("اختر","");
        $employees = Employee::where("job_id",JobNameEnum::Observer)->pluck('name', 'id')->prepend("اختر","");
        return view('components.work-executed-info',compact('employees', 'contractors'));
    }
}
