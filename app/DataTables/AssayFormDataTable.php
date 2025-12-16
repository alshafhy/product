<?php

namespace App\DataTables;

use App\Models\AssayForm;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class AssayFormDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'assay_forms';
        $this->actionViewBlade = 'assay_forms.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AssayForm $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AssayForm $model)
    {
        return $model->newQuery()->with(['workType','workOrder']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $asssay_form_status= json_encode(config("const.assay_form"));
        return [
            'work_order_id' => new Column(['title' => __('models/assayForms.fields.work_order_id'), 'data' => 'work_order.work_display_number', 'orderable'=>false]),
            'work_type_id' => new Column(['title' => __('models/assayForms.fields.work_type_id'),
                'data' => 'work_type.full_name',
                'render' => 'function() {
                                    if (typeof data === "undefined") {
                                    return "-";
                                    }
                                    return data;
                                }',
                'orderable'=>false]),
            'amount' => new Column(['title' => __('models/assayForms.fields.amount'), 'data' => 'amount']),
            'notes' => new Column(['title' => __('models/assayForms.fields.notes'), 'data' => 'notes', 'orderable'=>false]),
            'status' => new Column([
                'title' => __('models/assayForms.fields.status'),
                'data' => 'status',
                'render' => 'function() {
                                    var $status =' . $asssay_form_status   .';
                                    if (typeof $status[data] === "undefined") {
                                    return data;
                                    }
                                    return ( \'<span class="badge rounded-pill \' + $status[data].class + \'">\' + $status[data].title + \'</span>\'  );
                                }'
            ]),
            'created_at' => new Column(['title' => __('models/assayForms.fields.created_at'), 'data' => 'created_at']),
        ];
    }

}
