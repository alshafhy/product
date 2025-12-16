<?php

namespace App\Http\Controllers\Reports;

use PDF;
use Carbon\Carbon;
use App\Models\WorkOrderV;
use Illuminate\Http\Request;
use App\Models\SystemComponent;
use App\Models\WorkOrderFollowV;
use App\Models\WorkOrdersPermitsFine;
use App\Http\Controllers\Reports\ReportController;



class TopManagementReportsController extends ReportController
{
    public $workOrder ;
    public $workOrderFollow ;
    public $workOrdersPermitsFine ;

    public function __construct(WorkOrderV $workOrder ,WorkOrderFollowV $WorkOrderFollow,WorkOrdersPermitsFine $workOrdersPermitsFine) {
        $this->workOrder = $workOrder;
        $this->workOrderFollow = $WorkOrderFollow;
        $this->workOrdersPermitsFine = $workOrdersPermitsFine;
    }

    public function allRecivedOrdersReport(Request $request)
    {
        $reportName = 'unfinishedDrillingWorkOrdersReport';
        $workOrders = $this->workOrder
                        ->getDrillingWorkOrders()
                        ->filter('reports.'.$reportName.'.filter')
                        ->withAggregate('workType','code')
                        ->withAggregate('currentDepartment','name')
                        ->withAggregate('assay_forms','id')
                        ->withAggregate('electricityDepartment','name')
                        ->withAggregate('consultant','name')
                        ->withAggregate('landscape','length_total')
                        ->get();
                        $workOrders->rowCount = $workOrders->count() ;
                        $workOrders->landscapeLengthTotal = $workOrders->sum('landscape_length_total') ;
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }


    public function permitFinesAmountsReport(Request $request)
    {
        $reportName = 'permitFinesAmountsReport';
        $workOrderFollow = $this->workOrdersPermitsFine
                ->getRestablishWorkOrders()
                ->filter('reports.'.$reportName.'.filter')
                ->get();
        $pdf = $this->getPDF($reportName,$workOrderFollow);
        return $this->handlePDF($request,$pdf);
    }


    public function totalPermitAmountsReport(Request $request)
    {
        $reportName = 'totalPermitAmountsReport';
        $workOrderFollow = $this->workOrderFollow

                ->getRestablishWorkOrders()
                ->filter('reports.'.$reportName.'.filter')
                ->with(["workOrders.district" , "workOrders.workType" , 'restablishWorkOrders'])
                ->get();
        // dd($workOrderFollow);
        $pdf = $this->getPDF($reportName,$workOrderFollow);
        return $this->handlePDF($request,$pdf);
    }





}
