<?php

namespace App\Http\Controllers\Reports;

use PDF;
use Carbon\Carbon;
use App\Models\WorkOrderV;
use Illuminate\Http\Request;
use App\Models\SystemComponent;
use App\Http\Controllers\Reports\ReportController;



class FinancialDuesReportsController extends ReportController
{
    public $workOrder ;

    public function __construct(WorkOrderV $workOrder) {
        $this->workOrder = $workOrder;
    }

    public function ordersWithOutCertificatesReport(Request $request)
    {
        $reportName = 'ordersWithOutCertificatesReport';
        $workOrders = $this->workOrder
                        ->filter('reports.'.$reportName.'.filter')
                        // ->getElectricTowersWorkOrders()
                        ->withAggregate('workType','code')
                        ->withAggregate('currentDepartment','name')
                        ->withAggregate('assay_forms','id')
                        ->get();
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }


    public function ordersWithOutFinancialDuesReport(Request $request)
    {
        $reportName = 'ordersWithOutFinancialDuesReport';
        $workOrders = $this->workOrder
                        ->filter('reports.'.$reportName.'.filter')
                        // ->getElectricTowersWorkOrders()
                        ->withAggregate('workType','code')
                        ->withAggregate('currentDepartment','name')
                        ->withAggregate('assay_forms','id')
                        ->get();
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }


    public function finishedFinancialDuesReport(Request $request)
    {
        $reportName = 'finishedFinancialDuesReport';
        $workOrders = $this->workOrder
                        ->filter('reports.'.$reportName.'.filter')
                        // ->getElectricTowersWorkOrders()
                        ->withAggregate('workType','code')
                        ->withAggregate('currentDepartment','name')
                        ->withAggregate('assay_forms','id')
                        ->get();
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }


    public function allFinancialDuesReport(Request $request)
    {
        $reportName = 'allFinancialDuesReport';
        $workOrders = $this->workOrder
                        ->filter('reports.'.$reportName.'.filter')
                        // ->getElectricTowersWorkOrders()
                        ->withAggregate('workType','code')
                        ->withAggregate('currentDepartment','name')
                        ->withAggregate('assay_forms','id')
                        ->get();
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }
   

} 