<?php

namespace App\DataTables;

use App\Models\Item;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class ItemDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'items';
        $this->actionViewBlade = 'items.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Item $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Item $model)
    {
        return $model->newQuery()->with(['category','unit']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'index'=> $this->getIndexCol(),
            'code' => new Column(['title' => __('models/items.fields.code'), 'data' => 'code']),
            'name' => new Column(['title' => __('models/items.fields.name'), 'data' => 'name']),
            // 'name_ar' => new Column(['title' => __('models/items.fields.name_ar'), 'data' => 'name_ar']),
            // 'description' => new Column(['title' => __('models/items.fields.description'), 'data' => 'description']),
            'unit_id' => new Column(['title' => __('models/items.fields.unit_name'), 'data' => 'unit.name']),
            'items_category_id' => new Column(['title' => __('models/items.fields.items_category_name'), 'data' => 'category.name'])
        ];
    }

}
