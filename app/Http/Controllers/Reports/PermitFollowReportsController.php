<?php

namespace App\Http\Controllers\Reports;

use PDF;
use Carbon\Carbon;
use App\Models\WorkOrderFollowV;
use Illuminate\Http\Request;
use App\Models\SystemComponent;
use App\Http\Controllers\Reports\ReportController;



class PermitFollowReportsController extends ReportController
{
    public $workOrderFollow ;

    public function __construct(WorkOrderFollowV $WorkOrderFollow) {
        $this->workOrderFollow = $WorkOrderFollow;
    }


    public function workOrdersPermitReport(Request $request)
    {
        $reportName = 'workOrdersPermitReport';
        $workOrderFollow = $this->workOrderFollow
            
                        ->getRestablishWorkOrders()
                        ->filter('reports.'.$reportName.'.filter')
                        ->with(["workOrders.district" , "workOrders.workType" , 'restablishWorkOrders'])
                        ->get();
// dd($workOrderFollow);
        $pdf = $this->getPDF($reportName,$workOrderFollow);
        return $this->handlePDF($request,$pdf);
    }

//     function unfinishedDrillingWorkOrdersReport(Request $request) {
//         $reportName = 'unfinishedDrillingWorkOrdersReport';
//         $workOrders = $this->workOrder
//                         ->getDrillingWorkOrders()
//                         ->filter('reports.'.$reportName.'.filter')
//                         ->withAggregate('workType','code')
//                         ->withAggregate('currentDepartment','name')
//                         ->withAggregate('assay_forms','id')
//                         ->withAggregate('electricityDepartment','name')
//                         ->withAggregate('consultant','name')
//                         ->withAggregate('landscape','length_total')
//                         ->get();
//         $pdf = $this->getPDF($reportName,$workOrders);
//         return $this->handlePDF($request,$pdf);
//     }

//     function finishedDrillingWorkOrdersReport(Request $request) {
//         $reportName = 'finishedDrillingWorkOrdersReport';
//         $workOrders = $this->workOrder
//                         ->getFinishedDrillingWorkOrders()
//                         ->filter('reports.'.$reportName.'.filter')
//                         ->withAggregate('workType','code')
//                         ->withAggregate('currentDepartment','name')
//                         ->withAggregate('assay_forms','id')
//                         ->get();

//         $pdf = $this->getPDF($reportName,$workOrders);
//         return $this->handlePDF($request,$pdf);
//    }
    

}
