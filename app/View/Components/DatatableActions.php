<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatatableActions extends Component
{
    public $screenName;
    public $rowID;
    public $buttons;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($screenName,$rowID,$buttons=["show","edit","delete"])
    {
        $this->screenName=$screenName;
        $this->rowID=$rowID;
        $this->buttons=$buttons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datatable-actions');
    }
}
