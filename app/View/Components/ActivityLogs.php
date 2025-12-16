<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActivityLogs extends Component
{
    public $activities;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($activities)
    {
        $this->activities = $activities;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.activity-logs');
    }
}
