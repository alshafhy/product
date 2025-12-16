<?php

namespace App\DataTables;

use App\Models\ReturnSituation;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class ReturnSituationDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'return_situations';
        $this->actionViewBlade = 'return_situations.datatables_actions';
    }


//  /**
//      * Optional method if you want to use html builder.
//      *
//      * @return \Yajra\DataTables\Html\Builder
//      */
//     public function html()
//     {
//         return $this->builder()
//             ->columns($this->getColumns())
//             ->minifiedAjax()
//             ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            
//             ->parameters([
//                 "dom"=> 'Bflrtip',//Bfrtip
//                 'stateSave' => false,
//                 'pageLength'=> 15,
//                 'lengthMenu'=> [5,10,15,20,30],
//                 'order'     => [[0, 'desc']],
//                 // "orderColumn" =>['id', '-id $1'],
//                 'drawCallback' => 'function() { feather.replace({width: 14,height: 14}); }',
//                 // 'initComplete' => 'function() {  }',
//                 'buttons'   => [
//                     [
//                        'extend' => 'print',
//                        'className' => 'btn btn-primary btn-sm no-corner',
//                        'text' => '<i data-feather="printer"></i> ' .__('auth.app.print').'',
//                        'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary");$(node).removeClass("buttons-print");}'
//                     ],
//                     [
//                        'extend' => 'reload',
//                        'className' => 'btn btn-primary btn-sm no-corner',
//                        'text' => '<i data-feather="refresh-cw"></i> ' .__('auth.app.reload').'',
//                        'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'
//                     ],
//                     [
//                         'extend' => 'reset',
//                         'className' => 'btn btn-primary btn-sm no-corner',
//                         'text' => '<i data-feather="repeat"></i> ' .__('auth.app.reset').'',
//                         'init'=> 'function(api, node, config) {$(node).removeClass("btn-secondary")}'
//                      ],
//                 ],
//                  'language' => [
//                    'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/Arabic.json'),
//                  ],
//             ]);
//     }



    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReturnSituation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ReturnSituation $model)
    {
        // return $model->newQuery()->with(["district","workType"]);
        return $model->newQuery()->where("status",3)->where("current_department_id",4)->with(["district","workType"]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $work_order_status= json_encode(config("const.work_order_general_status"));
        return [
            'index'=> $this->getIndexCol(),
            'work_order_number' => new Column(['title' => __('models/workOrders.fields.work_order_number'), 'data' => 'work_order_number']),
            'reference_number' => new Column(['title' => __('models/workOrders.fields.reference_number'), 'data' => 'reference_number']),
            'received_date' => new Column(['title' => __('models/workOrders.fields.received_date'), 'data' => 'received_date']),
            'work_type_id' => new Column(['title' => __('models/workOrders.fields.work_type_name'), 'data' => 'work_type.name']),
            'district_id' => new Column(['title' => __('models/workOrders.fields.district_name'), 'data' => 'district.name']),
            'customer_number' => new Column(['title' => __('models/workOrders.fields.customer_number'), 'data' => 'customer_number']),
            'customer_name' => new Column(['title' => __('models/workOrders.fields.customer_name'), 'data' => 'customer_name']),
            'work_period' => new Column(['title' => __('models/workOrders.fields.work_period'), 'data' => 'work_period']),
            'status' => new Column([
                'title' => __('models/workOrders.fields.status'), 
                'data' => 'status',
                'render' => 'function() {
                                    var $status =' . $work_order_status   .';
                                    if (typeof $status[data] === "undefined") {
                                    return data;
                                    }
                                    return ( \'<span class="badge rounded-pill \' + $status[data].class + \'">\' + $status[data].title + \'</span>\'  );
                                }'
            ])

        ];
    }

}
