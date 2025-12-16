<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class FormSubmitButtons extends Component
{
    public $cancelroute;
    public $screenname;
    public $action;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $screenname,$cancelroute)
    {
        if (strpos(Route::currentRouteName(), "create") !== false) {
            $this->action = 'create';
        }
        if (strpos(Route::currentRouteName(), "edit") !== false) {
            $this->action = 'edit';
        }
        $this->cancelroute=$cancelroute;
        $this->screenname=$screenname;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-submit-buttons');
    }
}
