<?php

namespace App\View\Components\Report;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterDescription extends Component
{
    public $reportRouteName;
    /**
     * Create a new component instance.
     */
    public function __construct($reportRouteName)
    {
        $this->reportRouteName=$reportRouteName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $html="";
        if($this->reportRouteName){
            // dd($this->reportRouteName);
            $searchArr = session('reports.'.$this->reportRouteName.'.filter') ;  
            if(!empty($searchArr)){
                // dd($searchArr);
                foreach ($searchArr as $key => $value) {
                    if($value){
                        if (str_contains($value,"||")){
                            $arr =explode("||",$value);
                            $value =$arr[1];
                        }
                        $line=__("report-filter.".$this->reportRouteName.".".$key) . " " . $value . " ";
                        $html= $html.$line;
                        
                        
                    }
                    
                }

            }
        }

        return view('components.report.filter-description', compact('html'));
    }
}
