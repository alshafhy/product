<?php

namespace App\View\Components\Attachment;

use App\Models\AttachmentType;
use Illuminate\View\Component;

class Files extends Component
{
    public $required = [];
    public $categories;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($required, $categories = null)
    {
        $this->required = is_array($required)? $required : explode(",", $required);
        if ($categories){
            $this->categories = $categories;
        }else{
            $this->categories  = AttachmentType::get();
        }
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        return view('components.attachment.files');
    }
}
