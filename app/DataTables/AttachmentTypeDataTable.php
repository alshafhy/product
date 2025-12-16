<?php

namespace App\DataTables;

use App\Models\AttachmentType;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class AttachmentTypeDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'attachment_types';
        $this->actionViewBlade = 'attachment_types.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AttachmentType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AttachmentType $model)
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
            'title' => new Column(['title' => __('models/attachmentTypes.fields.title'), 'data' => 'title']),
            'description' => new Column(['title' => __('models/attachmentTypes.fields.description'), 'data' => 'description'])
        ];
    }

}
