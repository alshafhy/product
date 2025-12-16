<?php

namespace App\DataTables;

use App\Models\ServicesCategory;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class ServicesCategoryDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'services_categories';
        $this->actionViewBlade = 'services_categories.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ServicesCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ServicesCategory $model)
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
            'name' => new Column(['title' => __('models/servicesCategories.fields.name'), 'data' => 'name']),
            'name_ar' => new Column(['title' => __('models/servicesCategories.fields.name_ar'), 'data' => 'name_ar'])
        ];
    }

}
