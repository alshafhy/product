<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectricMeter;
use App\View\Components\FormRepeater\Column;

class FormsController extends Controller
{
    // Form Elements - Input
    public function input()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Input"]
        ];
        return view('/content/forms/form-elements/form-input', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Input-groups
    public function input_groups()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Input Groups"]
        ];
        return view('/content/forms/form-elements/form-input-groups', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Input-mask
    public function input_mask()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Input Mask"]
        ];
        return view('/content/forms/form-elements/form-input-mask', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Textarea
    public function textarea()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Textarea"]
        ];
        return view('/content/forms/form-elements/form-textarea', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Checkbox
    public function checkbox()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Checkbox"]
        ];
        return view('/content/forms/form-elements/form-checkbox', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Radio
    public function radio()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Radio"]
        ];
        return view('/content/forms/form-elements/form-radio', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - custom_options
    public function custom_options()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Custom Options"]
        ];
        return view('/content/forms/form-elements/form-custom-options', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Switch
    public function switch()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Switch"]
        ];
        return view('/content/forms/form-elements/form-switch', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Select
    public function select()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Select"]
        ];
        return view('/content/forms/form-elements/form-select', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Number Input
    public function number_input()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Number Input"]
        ];
        return view('/content/forms/form-elements/form-number-input', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // File Uploader
    public function file_uploader()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "File Uploader"]
        ];
        return view('/content/forms/form-elements/form-file-uploader', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Quill Editor
    public function quill_editor()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Quill Editor"]
        ];
        return view('/content/forms/form-elements/form-quill-editor', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Elements - Date & time Picker
    public function date_time_picker()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form Elements"], ['name' => "Date & Time Picker"]
        ];
        return view('/content/forms/form-elements/form-date-time-picker', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Layouts
    public function layouts()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Layouts"]
        ];
        return view('/content/forms/form-layout', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Wizard
    public function wizard()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Wizard"]
        ];
        return view('/content/forms/form-wizard', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form Validation
    public function validation()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Validation"]
        ];
        return view('/content/forms/form-validation', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }
    // Form repeater
    public function form_repeater()
    {
       if($_POST) dd($_POST);
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Repeater"]
        ];
        return view('/content/forms/form-repeater', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Form repeater
    public function new_form_repeater()
    {
        $invoiceDetilsOptions=[
            "columns"=>$this->getColumns() 
        ];
        
        if($_POST){
            // dd($_POST);
            $collection = collect($_POST['invoices']);
            $filtered = $collection->reject(function ($item, $key) {
                return empty(array_filter($item, function ($a) { return $a !="" ;}));
            });
            $invoices = $filtered->all();
            $this->saveElectricMeters($invoices);
            dd($invoices);

        } 
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Forms"], ['name' => "Form Repeater"]
        ];
        return view('/content/forms/form-repeater-new', [
            'breadcrumbs' => $breadcrumbs,
            'invoiceDetilsOptions'=>$invoiceDetilsOptions
        ]);
    }

    public function saveElectricMeters($data)
    {
        if($data){
            // $reading = $request->get('reading');
            foreach ($data as $val){
                // if (empty($meter_no) || empty($subscription_no[$i])){
                //     continue;
                // }
                ElectricMeter::create([
                    'work_order_id' => 2,
                    'meter_no' => $val['meter_no'],
                    'reading' => $val['reading'],
                    'subscription_no' => $val['reading'],
                    'user_id' => auth()->id()
                ]);
                // $total_electrical_counters++;
            }
        }
    }

    public function getColumns()
    {
        // $work_order_status= json_encode(config("const.work_order_general_status"));
        return [
            'meter_no' => new Column(['title' => 'رقم الاشتراك', 'data' => 'meter_no']),
            'subscription_no' => new Column(['title' =>'القراءة السابقة', 'data' => 'subscription_no']),
            'reading' => new Column(['title' => 'رقم العداد', 'data' => 'reading'])
            
        ];


        return [
            'id' => new Column([
                'title' => __('models/workOrders.fields.id'), 
                'data' => 'id',
                'width'=>"5%",
                'name'=>"id",
                'type'=>"hidden",
                'value'=>"5"
            ]),
            'work_order_number' => new Column(['title' => __('models/workOrders.fields.work_order_number'), 'data' => 'work_order_number']),
            'reference_number' => new Column(['title' => __('models/workOrders.fields.reference_number'), 'data' => 'reference_number']),
            'received_date' => new Column(['title' => __('models/workOrders.fields.received_date'), 'data' => 'received_date']),
            'work_type_id' => new Column([
                'title' => __('models/workOrders.fields.work_type_name'), 
                'data' => 'work_type.full_name',
                'width'=>"5%",
                'orderable'      => false,
                'searchable'     => false
            ]),
            
        ];
    }

}
