<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\Utils\NodeUtil;
use Illuminate\Support\Str;
use App\Utils\PermissionsUtil;
use App\Models\SystemComponent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;
use App\DataTables\SystemComponentDataTable;
use App\Http\Requests\CreateSystemComponentRequest;
use App\Http\Requests\UpdateSystemComponentRequest;

class SystemComponentController extends AppBaseController
{
    /**
     * Display a listing of the SystemComponent.
     *
     * @param SystemComponentDataTable $systemComponentDataTable
     * @return Response
     */
    public function index(SystemComponentDataTable $systemComponentDataTable)
    {
        return $systemComponentDataTable->render('system_components.index');
    }

    /**
     * Show the form for creating a new SystemComponent.
     *
     * @return Response
     */
    public function create()
    {
        $parents_list  = SystemComponent::whereIn('comp_type',array(1,2))->pluck('comp_ar_label' , 'id');
        $parents_list[''] = "اختار";


        $comp_type_list  = array(
                                1=>'نظام',
                                2=>'قائمة',
                                3=>'شاشة',
                                4=>'تقرير',
                                );
        $comp_type_list[''] = "اختار";

        return view('system_components.create')
                    ->with('parents_list', $parents_list )
                    ->with('comp_type_list',$comp_type_list);
    }

    /**
     * Store a newly created SystemComponent in storage.
     *
     * @param CreateSystemComponentRequest $request
     *
     * @return Response
     */
    public function store(CreateSystemComponentRequest $request)
    {
        
        // dd($input);
        /** @var SystemComponent $systemComponent */
        DB::transaction(function () use($request ) {
            $input = $request->all();
            $result = NodeUtil::addNewNode($request);

            if($input['comp_type'] == 3 || $input['comp_type'] == 4) {
                (new PermissionsUtil)->addPermissionsToObject($result->id);
            }
        });
        
        Flash::success(__('messages.saved', ['model' => __('models/systemComponents.singular')]));

        return redirect(route('systemComponents.index'));
    }

    /**
     * Display the specified SystemComponent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SystemComponent $systemComponent */
        $systemComponent = SystemComponent::find($id);

        if (empty($systemComponent)) {
            Flash::error(__('models/systemComponents.singular').' '.__('messages.not_found'));

            return redirect(route('systemComponents.index'));
        }

        return view('system_components.show')->with('systemComponent', $systemComponent);
    }

    /**
     * Show the form for editing the specified SystemComponent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var SystemComponent $systemComponent */
        $systemComponent = SystemComponent::find($id);

        if (empty($systemComponent)) {
            Flash::error(__('messages.not_found', ['model' => __('models/systemComponents.singular')]));

            return redirect(route('systemComponents.index'));
        }

        $parents_list  = SystemComponent::whereIn('comp_type',array(1,2))->pluck('comp_ar_label' , 'id');
        $parents_list[''] = "اختار";

        $comp_type_list  = array(
                                1=>'نظام',
                                2=>'قائمة',
                                3=>'شاشة',
                                4=>'تقرير',
                                );
        $comp_type_list[''] = "اختار";

        return view('system_components.edit')
                    ->with('systemComponent', $systemComponent)
                    ->with('parents_list', $parents_list)
                    ->with('comp_type_list', $comp_type_list)
                    ;
    }

    /**
     * Update the specified SystemComponent in storage.
     *
     * @param  int              $id
     * @param UpdateSystemComponentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSystemComponentRequest $request)
    {
        /** @var SystemComponent $systemComponent */
        $systemComponent = SystemComponent::find($id);

        if (empty($systemComponent)) {
            Flash::error(__('messages.not_found', ['model' => __('models/systemComponents.singular')]));

            return redirect(route('systemComponents.index'));
        }

        $systemComponent->fill($request->all());
        $systemComponent->save();

        Flash::success(__('messages.updated', ['model' => __('models/systemComponents.singular')]));

        return redirect(route('systemComponents.index'));
    }

    /**
     * Remove the specified SystemComponent from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SystemComponent $systemComponent */
        $systemComponent = SystemComponent::find($id);

        if (empty($systemComponent)) {
            Flash::error(__('messages.not_found', ['model' => __('models/systemComponents.singular')]));

            return redirect(route('systemComponents.index'));
        }

        $systemComponent->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/systemComponents.singular')]));

        return redirect(route('systemComponents.index'));
    }


}
