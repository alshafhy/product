<?php

namespace App\Http\Controllers\Reports;

use PDF;
use Carbon\Carbon;
use App\Models\WorkOrderV;
use Illuminate\Http\Request;
use App\Models\SystemComponent;
use App\Http\Controllers\Reports\ReportController;



class WorkOrdersReportsController extends ReportController
{
    public $workOrder ;

    public function __construct(WorkOrderV $workOrder) {
        $this->workOrder = $workOrder;
    }
    public function workOrdersGeneralReport(Request $request)
    {
        $reportName = 'workOrdersGeneralReport';
        $workOrders = $this->workOrder
                        ->filter('reports.'.$reportName.'.filter')
                        ->withAggregate('workType','code')
                        ->withAggregate('currentDepartment','name')
                        ->withAggregate('assay_forms','id')
                        ->get();
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }

    function unfinishedDrillingWorkOrdersReport(Request $request) {
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

    function finishedDrillingWorkOrdersReport(Request $request) {
        $reportName = 'finishedDrillingWorkOrdersReport';
        $workOrders = $this->workOrder
                        ->getFinishedDrillingWorkOrders()
                        ->filter('reports.'.$reportName.'.filter')
                        ->withAggregate('workType','code')
                        ->withAggregate('currentDepartment','name')
                        ->withAggregate('assay_forms','id')
                        ->get();

        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
   }

   function electricTowerWorkOrdersReport(Request $request) {
        $reportName = 'electricTowerWorkOrdersReport';
        $workOrders = $this->workOrder
                    ->getElectricTowersWorkOrders()
                    ->filter('reports.'.$reportName.'.filter')
                    ->withAggregate('workType','code')
                    ->withAggregate('district','name')
                    ->withAggregate('currentDepartment','name')
                    // ->withAggregate('assay_forms','id')
                    // ->withAggregate('electricityDepartment','name')
                    ->withAggregate('consultant','name')
                    ->withAggregate('landscape','length_total')
                    ->with("electricity_tower")
                    ->get();
                    // $model->getElectricTowersWorkOrders()->with(["district","workType","currentDepartment", "electricity_tower"]);
        //    dd($workOrders);         
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }

    function finishedElectricyWorkOrdersReport(Request $request) {
        $reportName = 'finishedElectricyWorkOrdersReport';
        $workOrders = $this->workOrder
                    ->getElectricWorkOrders()
                    ->filter('reports.'.$reportName.'.filter')
                    ->withAggregate('workType','code')
                    ->withAggregate('district','name')
                    ->withAggregate('currentDepartment','name')
                    ->withAggregate('consultant','name')
                    ->with("electrical_operation")
                    ->get();  
                    
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }

    function electricyOperationsReport(Request $request) {
        $reportName = 'electricyOperationsReport';
        $workOrders = $this->workOrder
                    ->getElectricWorkOrders()
                    ->filter('reports.'.$reportName.'.filter')
                    ->withAggregate('workType','code')
                    ->withAggregate('district','name')
                    ->withAggregate('currentDepartment','name')
                    ->withAggregate('consultant','name')
                    ->with("electrical_operation")
                    ->get();  
                    
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }

    function electricyCountersReport(Request $request) {
        $reportName = 'electricyCountersReport';
        $workOrders = $this->workOrder
                    ->getElectricWorkOrders()
                    ->filter('reports.'.$reportName.'.filter')
                    ->withAggregate('workType','code')
                    ->withAggregate('district','name')
                    ->withAggregate('currentDepartment','name')
                    ->withAggregate('consultant','name')
                    ->with("electrical_operation")
                    ->get();  
                    
        $pdf = $this->getPDF($reportName,$workOrders);
        return $this->handlePDF($request,$pdf);
    }
} 