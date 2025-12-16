<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NumberTouchSpin extends Component
{
    public $name;
    public $labelTitle;
    public $defaultValue;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$labelTitle="",$defaultValue=null)
    {
        $this->name=$name;
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
        return view('components.number-touch-spin');
    }
}
