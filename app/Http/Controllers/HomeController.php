<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\AssayForm;
use App\Models\WorkOrder;
use App\Models\WorkOrderV;
use App\Models\FinancialDue;
use Aws\Crypto\Polyfill\Key;
use Illuminate\Http\Request;
use App\Models\WorkOrdersPermitV;
use App\Utils\GeographicPointUtil;
use App\Models\AchievementCertificate;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $colorCount = Color::count();
        $productCount = Product::count();
        $sizeCount = Size::count();

        // Use dummy variables for unused sections if needed to prevent undefined variable errors in view before cleanup
        $workOrderCount = 0;
        $workOrdersPermitCount = 0;
        $workEmergencyOrderCount = 0;
        $financialDueCount = 0;
        $assayFormsCount = 0;
        $finishedWorkOrderCount = 0;
        $achievementCertificateCount = 0;
        $financialDueWorkOrderCount = 0;

        return view('dashboard.dashboard-dev', compact(
            'colorCount',
            'productCount',
            'sizeCount',
            // Keep passing these for now until view is updated
            'workOrderCount',
            'workOrdersPermitCount',
            'workEmergencyOrderCount',
            'financialDueCount',
            'assayFormsCount',
            'achievementCertificateCount',
            'financialDueWorkOrderCount',
            'finishedWorkOrderCount'
        ));
        // return view('dashboard.dashboard-default');
        // return view('home');
    }
    public function underMaintenance()
    {
        return view('page-maintenance');
    }

    public function pageComingSoon()
    {
        return view('page-coming-soon');
    }

    public function convertDimention($easting, $northing)
    {
        return GeographicPointUtil::createXYPoint($easting, $northing);
    }

    public function testPdf(Request $request)
    {
        $reportTemplate = "pdf.templates.template4"; //pdf.testReport
        $report = [
            'font_name' => 'calibri',
            'font_size' => '18',
            'title_background_color' => '4CAF50'
        ];
        $data = [
            //'data'=>$assayForm,
            'dateTime' => Carbon::now()->format('h:i Y-m-d'),

            'report' => $report

        ];
        // $pdf = PDF::loadView('pdf.testReport');
        $pdf = PDF::loadView($reportTemplate, $data, [], [
            'title' => 'تقرير أوامر العمل',
            // 'orientation' => 'L'
        ]);

        if ($request->has('preview')) {
            return view($reportTemplate, $data);
        }

        if ($request->has('download')) {
            return $pdf->download();
        }

        return $pdf->stream();
    }

    public function workOrderReport(Request $request)
    {
        if (session('reports.workOrderReport.filter')) {
            $workOrders = WorkOrderV::get();
            $filterArray = session('reports.workOrderReport.filter');
            foreach ($filterArray as $key => $value) {
                $workOrders = $workOrders->where($key, $value);
            }

            session()->forget('reports.workOrderReport.filter');
            $filterArray = session('reports.workOrderReport.filter');
            // dd( $filterArray );

        } else {
            $workOrders = WorkOrderV::get();
        }

        // dd($workOrders);
        $reportTemplate = "pdf.workOrdersTestReport"; //pdf.testReport
        $report = [
            'font_name' => 'calibri',
            'font_size' => '18',
            'title_background_color' => '4CAF50'
        ];
        $data = [
            'data' => $workOrders,
            'dateTime' => Carbon::now()->format('h:i Y-m-d'),

            'report' => $report

        ];
        // $pdf = PDF::loadView('pdf.testReport');
        $pdf = PDF::loadView($reportTemplate, $data, [], [
            'title' => 'تقرير أوامر العمل',
            // 'orientation' => 'L'
        ]);

        if ($request->has('preview')) {
            return view($reportTemplate, $data);
        }

        if ($request->has('download')) {
            return $pdf->download();
        }

        return $pdf->stream();
    }

    public function previewPdf(Request $request)
    {
        //dd($request->all());
        // $pdf = "/testPdf";
        $pdf = "/workOrderReport";
        // $where = array('work_order_number'=> '20202000');
        $where = $request->all();
        //dd( $where );
        // $where = array();
        if (!empty($where)) {
            session(['reports.workOrderReport.filter' => $where]);
        } else {
            session()->forget('reports.workOrderReport.filter');
        }

        // return view('pdf.testDisplayReport',compact("pdf"));

        // return view('pdf.report-preview',compact("pdf"));
        return view('pdf.report-example', compact("pdf"));
    }
}
