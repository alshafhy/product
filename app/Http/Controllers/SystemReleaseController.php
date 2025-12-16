<?php

namespace App\Http\Controllers;

use App\DataTables\SystemReleaseDataTable;
use App\Http\Requests\CreateSystemReleaseRequest;
use App\Http\Requests\UpdateSystemReleaseRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\SystemReleasesFeature;
use App\Models\SystemRelease;
use Illuminate\Http\Request;
use Flash;

class SystemReleaseController extends AppBaseController
{
    /**
     * Display a listing of the SystemRelease.
     */
    public function index(SystemReleaseDataTable $systemReleaseDataTable)
    {
    return $systemReleaseDataTable->render('system_releases.index');
    }


    /**
     * Show the form for creating a new SystemRelease.
     */
    public function create()
    {
        return view('system_releases.create');
    }

    /**
     * Store a newly created SystemRelease in storage.
     */
    public function store(CreateSystemReleaseRequest $request)
    {
        $input = $request->all();

        /** @var SystemRelease $systemRelease */
        $systemRelease = SystemRelease::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/systemReleases.singular')]));

        return redirect(route('systemReleases.index'));
    }

    /**
     * Display the specified SystemRelease.
     */
    public function show($id)
    {
        /** @var SystemRelease $systemRelease */
        $systemRelease = SystemRelease::find($id);

        if (empty($systemRelease)) {
            Flash::error(__('models/systemReleases.singular').' '.__('messages.not_found'));

            return redirect(route('systemReleases.index'));
        }

        return view('system_releases.show')->with('systemRelease', $systemRelease);
    }

    /**
     * Show the form for editing the specified SystemRelease.
     */
    public function edit($id)
    {
        /** @var SystemRelease $systemRelease */
        $systemRelease = SystemRelease::find($id);

        if (empty($systemRelease)) {
            Flash::error(__('models/systemReleases.singular').' '.__('messages.not_found'));

            return redirect(route('systemReleases.index'));
        }

        return view('system_releases.edit')->with('systemRelease', $systemRelease);
    }

    /**
     * Update the specified SystemRelease in storage.
     */
    public function update($id, UpdateSystemReleaseRequest $request)
    {
        /** @var SystemRelease $systemRelease */
        $systemRelease = SystemRelease::find($id);

        if (empty($systemRelease)) {
            Flash::error(__('models/systemReleases.singular').' '.__('messages.not_found'));

            return redirect(route('systemReleases.index'));
        }

        $systemRelease->fill($request->all());
        $systemRelease->save();

        Flash::success(__('messages.updated', ['model' => __('models/systemReleases.singular')]));

        return redirect(route('systemReleases.index'));
    }

    /**
     * Remove the specified SystemRelease from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var SystemRelease $systemRelease */
        $systemRelease = SystemRelease::find($id);

        if (empty($systemRelease)) {
            Flash::error(__('models/systemReleases.singular').' '.__('messages.not_found'));

            return redirect(route('systemReleases.index'));
        }

        $systemRelease->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/systemReleases.singular')]));

        return redirect(route('systemReleases.index'));
    }
    public function systemReleasesShow()
    {
        $releases = SystemRelease::all();
        $features = SystemReleasesFeature::get();
        return view('system_releases.systemReleasesShow', compact('releases','features'));
    }
}
