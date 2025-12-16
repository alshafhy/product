<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormRepeater extends Component
{
    /**
     * The name of data-repeater-list.
     *
     * @var string
     */
    public $name;
 

    /**
     * The options array for data-repeater.
     *
     * @var array
     */
    public $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$options)
    {
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-repeater');
    }
}
