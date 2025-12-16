<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use App\Models\SystemRelease;
use App\Models\SystemReleasesFeature;
use App\Http\Controllers\AppBaseController;
use App\DataTables\SystemReleasesFeatureDataTable;
use App\Http\Requests\CreateSystemReleasesFeatureRequest;
use App\Http\Requests\UpdateSystemReleasesFeatureRequest;

class SystemReleasesFeatureController extends AppBaseController
{
    /**
     * Display a listing of the SystemReleasesFeature.
     */
    public function index(SystemReleasesFeatureDataTable $systemReleasesFeatureDataTable)
    {
    return $systemReleasesFeatureDataTable->render('system_releases_features.index');
    }


    /**
     * Show the form for creating a new SystemReleasesFeature.
     */
    public function create()
    {
        $systemReleases = SystemRelease::pluck('version_number','id')->prepend("اختر","");
        // dd($systemReleases );
        return view('system_releases_features.create',compact(['systemReleases']));
    }

    /**
     * Store a newly created SystemReleasesFeature in storage.
     */
    public function store(CreateSystemReleasesFeatureRequest $request)
    {
        $input = $request->all();

        /** @var SystemReleasesFeature $systemReleasesFeature */
        $systemReleasesFeature = SystemReleasesFeature::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/systemReleasesFeatures.singular')]));

        return redirect(route('systemReleasesFeatures.index'));
    }

    /**
     * Display the specified SystemReleasesFeature.
     */
    public function show($id)
    {
        /** @var SystemReleasesFeature $systemReleasesFeature */
        $systemReleasesFeature = SystemReleasesFeature::find($id);

        if (empty($systemReleasesFeature)) {
            Flash::error(__('models/systemReleasesFeatures.singular').' '.__('messages.not_found'));

            return redirect(route('systemReleasesFeatures.index'));
        }

        return view('system_releases_features.show')->with('systemReleasesFeature', $systemReleasesFeature);
    }

    /**
     * Show the form for editing the specified SystemReleasesFeature.
     */
    public function edit($id)
    {
        /** @var SystemReleasesFeature $systemReleasesFeature */
        $systemReleasesFeature = SystemReleasesFeature::find($id);
        $systemReleases = SystemRelease::pluck('version_number','id')->prepend("اختر","");
        if (empty($systemReleasesFeature)) {
            Flash::error(__('models/systemReleasesFeatures.singular').' '.__('messages.not_found'));

            return redirect(route('systemReleasesFeatures.index'));
        }

        return view('system_releases_features.edit',compact(['systemReleasesFeature','systemReleases']));
    }

    /**
     * Update the specified SystemReleasesFeature in storage.
     */
    public function update($id, UpdateSystemReleasesFeatureRequest $request)
    {
        /** @var SystemReleasesFeature $systemReleasesFeature */
        $systemReleasesFeature = SystemReleasesFeature::find($id);

        if (empty($systemReleasesFeature)) {
            Flash::error(__('models/systemReleasesFeatures.singular').' '.__('messages.not_found'));

            return redirect(route('systemReleasesFeatures.index'));
        }

        $systemReleasesFeature->fill($request->all());
        $systemReleasesFeature->save();

        Flash::success(__('messages.updated', ['model' => __('models/systemReleasesFeatures.singular')]));

        return redirect(route('systemReleasesFeatures.index'));
    }

    /**
     * Remove the specified SystemReleasesFeature from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var SystemReleasesFeature $systemReleasesFeature */
        $systemReleasesFeature = SystemReleasesFeature::find($id);

        if (empty($systemReleasesFeature)) {
            Flash::error(__('models/systemReleasesFeatures.singular').' '.__('messages.not_found'));

            return redirect(route('systemReleasesFeatures.index'));
        }

        $systemReleasesFeature->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/systemReleasesFeatures.singular')]));

        return redirect(route('systemReleasesFeatures.index'));
    }
}
