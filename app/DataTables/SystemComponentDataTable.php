<?php

namespace App\DataTables;

use App\Models\SystemComponent;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class SystemComponentDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'system_components';
        $this->actionViewBlade = 'system_components.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SystemComponent $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SystemComponent $model)
    {
        return $model->withAggregate('parentData','comp_ar_label')->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'index'=> $this->getIndexCol(),
            'id' => new Column(['title' =>__('models/systemComponents.fields.id'), 'data' => 'id']),
            'comp_name' => new Column(['title' => __('models/systemComponents.fields.comp_name'), 'data' => 'comp_name']),
            'comp_ar_label' => new Column(['title' => __('models/systemComponents.fields.comp_ar_label'), 'data' => 'comp_ar_label']),
            //'comp_type' => new Column(['title' => __('models/systemComponents.fields.comp_type'), 'data' => 'comp_type']),
            'comp_type' => new Column([
                'title' => __('models/systemComponents.fields.comp_type'), 
                'data' => 'comp_type',
                'render' => 'function() {
                    if(data == 1){
                        return "نظام";
                    }else if(data ==2){
                        return "قائمة";
                    }else if(data ==3){
                        return "شاشة";
                    }else{
                        return "تقرير";
                    }
                    
                }'
            ]),
            'route_name' => new Column(['title' => __('models/systemComponents.fields.route_name'), 'data' => 'route_name']),
            'prefix' => new Column(['title' => __('models/systemComponents.fields.prefix'), 'data' => 'prefix']),
            'parent_data_comp_ar_label' => new Column([
                'title' => __('models/systemComponents.fields.parent_id'), 
                'data' => 'parent_data_comp_ar_label',
                "defaultContent"=> '',
                'orderable'      => false,
                'searchable'     => false,
                'printable'  =>false
            ]),
           
            // '_lft' => new Column(['title' => __('models/systemComponents.fields._lft'), 'data' => '_lft']),
            // '_rgt' => new Column(['title' => __('models/systemComponents.fields._rgt'), 'data' => '_rgt'])
            
        ];
    }

}
