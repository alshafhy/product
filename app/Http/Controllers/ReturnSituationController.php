<?php

namespace App\Http\Controllers;

use App\DataTables\ReturnSituationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateReturnSituationRequest;
use App\Http\Requests\UpdateReturnSituationRequest;
use App\Models\ReturnSituation;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Contractor;
use App\Models\Employee;
use App\Models\Layer;
use Response;

class ReturnSituationController extends AppBaseController
{
    /**
     * Display a listing of the ReturnSituation.
     *
     * @param ReturnSituationDataTable $returnSituationDataTable
     * @return Response
     */
    public function index(ReturnSituationDataTable $returnSituationDataTable)
    {
        return $returnSituationDataTable->render('return_situations.index');
    }

    /**
     * Show the form for creating a new ReturnSituation.
     *
     * @return Response
     */
    public function create()
    {
        return view('return_situations.create')->with('formMode','create');
    }

    /**
     * Store a newly created ReturnSituation in storage.
     *
     * @param CreateReturnSituationRequest $request
     *
     * @return Response
     */
    public function store(CreateReturnSituationRequest $request)
    {
        $input = $request->all();

        /** @var ReturnSituation $returnSituation */
        $returnSituation = ReturnSituation::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/returnSituations.singular')]));

        return redirect(route('returnSituations.index'));
    }

    /**
     * Display the specified ReturnSituation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ReturnSituation $returnSituation */
        $returnSituation = ReturnSituation::find($id);

        if (empty($returnSituation)) {
            Flash::error(__('models/returnSituations.singular').' '.__('messages.not_found'));

            return redirect(route('returnSituations.index'));
        }

        return view('return_situations.show')->with('returnSituation', $returnSituation);
    }

    /**
     * Show the form for editing the specified ReturnSituation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ReturnSituation $returnSituation */
        $returnSituation = ReturnSituation::find($id);

        if (empty($returnSituation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/returnSituations.singular')]));

            return redirect(route('returnSituations.index'));
        }
        
        $landLayers = $returnSituation->landLayers()->get();
        
        $layerWorkerTypeList = config("const.layer_worker_type_list") ; 
        $layerWorkerTypeList['']='اختر';
        
        $layerStatusList = config("const.return_situation_layer_status_list") ; 
        
        $labResultStatusList = config("const.lab_result_status_list") ; 
        $labResultStatusList['']='اختر';

        $layersList =Layer::pluck('name', 'id');
        $layersList->prepend("اختر","");

        $employeesList = Employee::pluck('name','id');
        $employeesList->prepend("اختر","");

        $contractorsList = Contractor::pluck('name','id');
        $contractorsList->prepend("اختر","");

        $layer_worker_type_list = config('const.layer_worker_type_list');

        return view('return_situations.edit' , compact('returnSituation','landLayers' , 
                                                        'layerWorkerTypeList', 'layerStatusList', 
                                                        'labResultStatusList' , 'layersList',
                                                        'employeesList' , 'contractorsList' ,
                                                        'layer_worker_type_list'
                                                        )
                                                    )->with('formMode','edit');
    }

    /**
     * Update the specified ReturnSituation in storage.
     *
     * @param  int              $id
     * @param UpdateReturnSituationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReturnSituationRequest $request)
    {
        /** @var ReturnSituation $returnSituation */
        $returnSituation = ReturnSituation::find($id);

        if (empty($returnSituation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/returnSituations.singular')]));

            return redirect(route('returnSituations.index'));
        }

        $returnSituation->fill($request->all());
        $returnSituation->save();

        Flash::success(__('messages.updated', ['model' => __('models/returnSituations.singular')]));

        return redirect(route('returnSituations.index'));
    }

    /**
     * Remove the specified ReturnSituation from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ReturnSituation $returnSituation */
        $returnSituation = ReturnSituation::find($id);

        if (empty($returnSituation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/returnSituations.singular')]));

            return redirect(route('returnSituations.index'));
        }

        $returnSituation->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/returnSituations.singular')]));

        return redirect(route('returnSituations.index'));
    }
}
