<?php

namespace App\View\Components\Attachment;

use App\Models\AttachmentType;
use Illuminate\View\Component;

class File extends Component
{
    public $required = [];
    public $categories;
    public $divContainerClass;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($required, $categories = array() , $divContainerClass = "")
    {
        $this->required = is_array($required)? $required : explode(",", $required);
        if($categories){
            $this->categories = $categories;
        }else{
            $this->categories   = AttachmentType::get();
        }
        if($divContainerClass){
            $this->divContainerClass   = $divContainerClass;
        }else{
            $this->divContainerClass   = "col-sm-6";
        } 
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.attachment.file');
    }
}
