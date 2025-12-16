<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatePickr extends Component
{
    public $name;
    public $labelTitle;
    public $placeholder;
    public $dateValue;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$labelTitle="",$dateValue=null,$placeholder="YYYY-MM-DD")
    {
        $this->name=$name;
        $this->dateValue=$dateValue;
        $this->labelTitle=$labelTitle;
        $this->placeholder=$placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.date-pickr');
    }
}
