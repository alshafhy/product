<?php

namespace App\Http\Controllers\Reports;

use PDF;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SystemComponent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    public function show($reportRouteName,Request $request)
    {
        $report = SystemComponent::where('route_name',$reportRouteName)->first();
        if(!$report){
            Flash::error(__('messages.not_found', ['model' => __('models/workOrders.singular')]));
            return redirect(route('home'));
        }
        $where = $request->except(['_token']);
        $sessionName='reports.'.$reportRouteName.'.filter' ;
        if(!empty($where)){
            session([$sessionName => $where]);
        }else{
            session()->forget($sessionName);
        }

        return view('pdf.show',compact("report","reportRouteName"));
    }

    function getPDF($reportName,$reportData)  {
        $reportComponent = SystemComponent::where('route_name',$reportName)->first();
        $config = $reportComponent->getConfig();
        $reportNumber = $reportComponent->getReportNumber();
        $data = [
            'data'=>$reportData,
            'dateTime'=>Carbon::now()->format('h:i Y-m-d'),
            'reportSettings'=>$config,
            'comp_name'=>$reportComponent->comp_name,
            'reportTitle'=>($reportComponent->description)?$reportComponent->description:$reportComponent->comp_ar_label,
            'reportNumber'=>$reportNumber
        ];
        $pdf = PDF::loadView($reportComponent->getReportTemplateName() ,$data,[],[
            'title' => $reportComponent->comp_ar_label,//'تقرير أوامر العمل',
            'orientation' => $config["orientation"] ?? 'P' // 'L' or 'P'
        ]);
        return $pdf;
    }

    function handlePDF($request,$pdf,$fileName = "")  {
        if ($request->has('preview')) {
            return $pdf->stream(); // return view($reportTemplate,$data);
        }

        if ($request->has('print')) {
            return $pdf->stream();
        }

        if ($request->has('save')) {
            $reportFileName= Str::uuid().'.pdf';// 'WorkOrder'.time().$request->id.'.pdf';
            $pdf->save(Storage::path($reportFileName));// $pdf->save(storage_path($reportName));
            return redirect(url($reportFileName));
        }

        if ($request->has('download')) {
            if ($fileName ){
                return $pdf->download($fileName.'.pdf');
            }else{
                return $pdf->download(Str::uuid().'.pdf');
            }
            
        }

        return $pdf->stream();
    }



}
