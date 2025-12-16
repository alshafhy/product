<?php

namespace App\DataTables;

use App\Models\Product;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class ProductDataTable extends AppDataTable
{
    function __construct()
    {
        $this->dataTableName = 'products';
        $this->actionViewBlade = 'products.datatables_actions';
    }

    public function query(Product $model)
    {
        return $model->newQuery()->with(['size', 'color']);
    }

    protected function getColumns()
    {
        return [
            'id' => new Column(['title' => __('models/products.fields.id'), 'data' => 'id']),
            'name' => new Column(['title' => __('models/products.fields.name'), 'data' => 'name']),
            'price' => new Column(['title' => __('models/products.fields.price'), 'data' => 'price']),
            'size.name' => new Column(['title' => __('models/products.fields.size_id'), 'data' => 'size.name', 'name' => 'size.name']),
            'color.name' => new Column(['title' => __('models/products.fields.color_id'), 'data' => 'color.name', 'name' => 'color.name'])
        ];
    }
}
