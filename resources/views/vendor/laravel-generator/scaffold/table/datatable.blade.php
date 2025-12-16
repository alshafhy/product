@php
    echo "<?php".PHP_EOL;
@endphp

namespace {{ $config->namespaces->dataTables }};

use {{ $config->namespaces->model }}\{{ $config->modelNames->name }};
@if($config->options->localized)
use Yajra\DataTables\Html\Column;
@endif
use App\DataTables\AppDataTable;

class {{ $config->modelNames->name }}DataTable extends AppDataTable
{
    function __construct() {
        $this->dataTableName = '{{ $config->modelNames->camelPlural }}';
        $this->actionViewBlade = '{{ $config->modelNames->camelPlural }}.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\{{ $config->modelNames->name }} $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query({{ $config->modelNames->name }} $model)
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
            {!! $columns !!}
        ];
    }

    
}
