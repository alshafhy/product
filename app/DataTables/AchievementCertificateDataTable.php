<?php

namespace App\DataTables;

use App\Models\AchievementCertificate;
use App\DataTables\AppDataTable;
use Yajra\DataTables\Html\Column;

class AchievementCertificateDataTable extends AppDataTable
{


    function __construct() {
        $this->dataTableName = 'achievement_certificates';
        $this->actionViewBlade = 'achievement_certificates.datatables_actions';
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AchievementCertificate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AchievementCertificate $model)
    {
        // dd($model->newQuery()->with(['workOrder'])->get());
        return $model->newQuery()->with(['workOrder']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $achievement_status= json_encode(config("const.achievement_cert_status_list"));
        return [
            'index'=> $this->getIndexCol(),
            'work_order_id' => new Column(['title' => __('models/achievementCertificates.fields.work_order_id'), 'data' => 'work_order.work_order_number']),
            'cert_date' => new Column(['title' => __('models/achievementCertificates.fields.cert_date'), 'data' => 'cert_date']),
            'status' => new Column([
                'title' => __('models/achievementCertificates.fields.status'),
                'data' => 'status',
                'render' => 'function() {
                                    var $status =' . $achievement_status   .';
                                    if (typeof $status[data] === "undefined") {
                                    return data;
                                    }
                                    return ( \'<span class="badge rounded-pill \' + $status[data].class + \'">\' + $status[data].title + \'</span>\'  );
                                }'
            ]),
            'amount' => new Column(['title' => __('models/achievementCertificates.fields.amount'), 'data' => 'amount']),
            'fines_amount' => new Column(['title' => __('models/achievementCertificates.fields.fines_amount'), 'data' => 'fines_amount']),
            'net_amount' => new Column(['title' => __('models/achievementCertificates.fields.net_amount'), 'data' => 'net_amount']),
            'notes' => new Column(['title' => __('models/achievementCertificates.fields.notes'), 'data' => 'notes'])
        ];
    }

}
