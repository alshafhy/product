<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CustomSwitch extends Component
{
    public $name;
    public $labelTitle;
    public $isCheckedByDefault;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$labelTitle="",$isCheckedByDefault=null)
    {
        $this->name=$name;
        $this->labelTitle=$labelTitle;
        $this->isCheckedByDefault=$isCheckedByDefault;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.custom-switch');
    }
}
