<?php

namespace App\DataTables;

use App\Models\ItemsCategory;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class ItemsCategoryDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'items_categories';
        $this->actionViewBlade = 'items_categories.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ItemsCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ItemsCategory $model)
    {
        return $model->newQuery()->with('category');
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
            'name' => new Column(['title' => __('models/itemsCategories.fields.name'), 'data' => 'name']),
            'name_ar' => new Column(['title' => __('models/itemsCategories.fields.name_ar'), 'data' => 'name_ar']),
            'parent_id' => new Column(['title' => __('models/itemsCategories.fields.parent_id'), 'data' => 'category.name'])
        ];
    }

}
