<?php

namespace App\View\Components\Attachment;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class FileList extends Component
{
    public $options;
    public $attachments;
    public $model;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model,$id, $options=[])
    {
        $this->options = array_replace_recursive(config('attachment.options'),$options);
        $this->model = $model;
        $this->id = $id;
        //dd($options,$this->options,config('attachment.options'));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $this->attachments = Attachment::where([
            'model_id'=>$this->id,
            'model_type'=>$this->model,
        ])->get();
        $fileCatgorycount = [];
        foreach ($this->attachments as $attachment) {
            if ( in_array($attachment->attachment_type_id,[1,2,3,5,9,10])){
                $fileCatgorycount[$attachment->attachment_type_id]= $attachment->attachment_type_id;
            }
        }
        $fileCatgorycount =count($fileCatgorycount);

        return view('components.attachment.file_list',compact('fileCatgorycount'));
    }
}
