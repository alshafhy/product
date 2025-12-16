<?php

namespace App\DataTables;

use App\Models\Color;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class ColorDataTable extends AppDataTable
{
    function __construct()
    {
        $this->dataTableName = 'colors';
        $this->actionViewBlade = 'colors.datatables_actions';
    }

    public function query(Color $model)
    {
        return $model->newQuery();
    }

    protected function getColumns()
    {
        return [
            'name' => new Column(['title' => __('models/colors.fields.name'), 'data' => 'name'])
        ];
    }
}
