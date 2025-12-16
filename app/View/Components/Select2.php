<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select2 extends Component
{
    public $name;
    public $labelTitle;
    public $defaultValue;
    public $options;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$labelTitle="",$options=[],$defaultValue=null,$class='select2 form-select form-control')
    {
        $this->name=$name;
        $this->labelTitle=$labelTitle;
        $this->defaultValue=$defaultValue;
        $this->options=$options;
        $this->class=$class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select2');
    }
}
