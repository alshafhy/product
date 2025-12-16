<?php

namespace App\Http\Controllers;

use App\Models\AssayForm;
use App\Models\AssayItem;
use App\Models\AssayService;
use App\Models\WorkOrderService;
use Illuminate\Http\Request;
use Flash;

class AssayServiceController extends AppBaseController
{
    public function store(Request $request)
    {

        request()->validate(AssayService::$rules);

        $input = $request->all();

        $service = WorkOrderService::find($input['service_id']);
        $input['price'] = $service->price * $input['quantity'];
        $result = AssayService::where([
            'service_id' => $input['service_id'],
            'assay_form_id' => $input['assay_form_id']
        ])->first();

        if ($result){
            $result->quantity = $input['quantity'] + $result->quantity;
            $result->price = $service->price * $input['quantity'];
            $result->save();
        } else {
            $result = AssayService::create($input);
        }

        $this->recalculateFormAmount($input['assay_form_id']);
        $result->price = number_format($result->price,2);
        $result->service_price = number_format($result->service_price,2);

        return [$result];
    }

    public function show($id)
    {
      $assayService = AssayService::find($id);
      if (empty($assayService)) {
          Flash::error('Assay item not found');
          return redirect(route('assayForms.index'));
      }
      return $assayService;

    }


    public function edit($id)
    {
      $assayService = AssayService::find($id);

      if (empty($assayService)) {
          Flash::error('Assay item not found');
          return redirect(route('assayForms.index'));
      }

      return $assayService;
    }


    public function update(Request $request, $id){
        $assayService = AssayService::find($id);

      if(empty($assayService)){
          Flash::error('Assay item is not found');
          return redirect(route('assayForms.index'));
      }

      $input = $request->all();

      $service = WorkOrderService::find($input['service_id']);
      $input['price'] = $service->price * $input['quantity'];

      $assayService->fill($input);
      $assayService->save();

      $this->recalculateFormAmount( $assayService->assay_form_id);
      return $assayService;
    }

    
    public function destroy($id)
    {
        $assayService = AssayService::find($id);

      if (empty($assayService)) {
          Flash::error('workOrdersPermitsExtension is not found');
          return redirect(route('assayForms.index'));
      }

        $assayService = $assayService->delete();
    }

    public function add_services($id, Request $request){
        foreach ($request->get('services') as $service_id => $count){
            if ($count == 0){
                continue;
            }

            $assayService = AssayService::where(['assay_form_id'=>$id, 'service_id'=>$service_id])->first();
            if(empty($ssayService)) {
                $assayService = AssayService::create([
                    'assay_form_id' => $id,
                    'service_id' => $service_id,
                    'quantity' => $count
                ]);
            }else{
                $assayService->quantity = $assayService->quantity + $count;
                $assayService->save();
            }

            $service = WorkOrderService::find($service_id);
            $assayService->price = $service->price * $assayService->quantity;
            $assayService->save();
        }

        $this->recalculateFormAmount($id);
        flash("تم إضافة البنود بنجاح")->success();
        return response()->json(['message'=>'تم إضافة البنود بنجاح']);
    }

    public function recalculateFormAmount($form_id){
        $assayForm = AssayForm::find($form_id);
        $assayServices = AssayService::where('assay_form_id',$form_id)->get();
        $amount = 0;
        foreach ($assayServices as $assayService){
            $amount += $assayService->price;
        }
        $assayForm->amount = $amount;
        $assayForm->save();
    }
  
}
