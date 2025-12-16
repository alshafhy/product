<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormToolbar extends Component
{
    
    public $actionname;
    public $screenname;
    public $key;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($actionname, $screenname,$key="")
    {
        $this->actionname=$actionname;
        //TODO: need another better way
        if($screenname == "workOrdersGeneral"){
            $screenname= "workOrders";
        }
        $this->screenname=$screenname;
        $this->key=$key;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-toolbar');
    }
}
