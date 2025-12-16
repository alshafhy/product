<?php

namespace App\DataTables;

use App\Models\Role;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class RoleDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'roles';
        $this->actionViewBlade = 'roles.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'index' => new Column([
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => __('index'),
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
            ]),
            // 'id' => new Column(['id' =>__('models/roles.fields.id'), 'data' => 'id']),
            'name' => new Column(['title' => __('models/roles.fields.name'), 'data' => 'name']),
            'ar_name' => new Column(['title_ar' => __('models/roles.fields.ar_name'), 'data' => 'ar_name'])
        ];
    }

}
