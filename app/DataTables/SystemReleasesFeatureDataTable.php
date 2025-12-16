<?php

namespace App\DataTables;

use App\Models\SystemReleasesFeature;
use Yajra\DataTables\Html\Column;
use App\DataTables\AppDataTable;

class SystemReleasesFeatureDataTable extends AppDataTable
{
    function __construct() {
        $this->dataTableName = 'systemReleasesFeatures';
        $this->actionViewBlade = 'system_releases_features.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SystemReleasesFeature $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SystemReleasesFeature $model)
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
            'index'=> $this->getIndexCol(),
            'system_release_id' => new Column(['title' => __('models/systemReleasesFeatures.fields.system_release_id'), 'data' => 'system_release_id']),
            'title' => new Column(['title' => __('models/systemReleasesFeatures.fields.title'), 'data' => 'title']),
            'description' => new Column(['title' => __('models/systemReleasesFeatures.fields.description'), 'data' => 'description']),
            'feature_order' => new Column(['title' => __('models/systemReleasesFeatures.fields.feature_order'), 'data' => 'feature_order'])
        ];
    }

    
}
