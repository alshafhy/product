<?php

namespace App\DataTables;

use App\Models\Size;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class SizeDataTable extends AppDataTable
{
    function __construct()
    {
        $this->dataTableName = 'sizes';
        $this->actionViewBlade = 'sizes.datatables_actions';
    }

    public function query(Size $model)
    {
        return $model->newQuery();
    }

    protected function getColumns()
    {
        return [
            'name' => new Column(['title' => __('models/sizes.fields.name'), 'data' => 'name'])
        ];
    }
}
