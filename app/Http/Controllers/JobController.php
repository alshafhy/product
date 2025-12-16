<?php

namespace App\Http\Controllers;

use App\DataTables\JobDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class JobController extends AppBaseController
{
    /**
     * Display a listing of the Job.
     *
     * @param JobDataTable $jobDataTable
     * @return Response
     */
    public function index(JobDataTable $jobDataTable)
    {
        return $jobDataTable->render('jobs.index');
    }

    /**
     * Show the form for creating a new Job.
     *
     * @return Response
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created Job in storage.
     *
     * @param CreateJobRequest $request
     *
     * @return Response
     */
    public function store(CreateJobRequest $request)
    {
        $input = $request->all();

        /** @var Job $job */
        $job = Job::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/jobs.singular')]));

        return redirect(route('jobs.index'));
    }

    /**
     * Display the specified Job.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Job $job */
        $job = Job::find($id);

        if (empty($job)) {
            Flash::error(__('models/jobs.singular').' '.__('messages.not_found'));

            return redirect(route('jobs.index'));
        }

        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified Job.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Job $job */
        $job = Job::find($id);

        if (empty($job)) {
            Flash::error(__('messages.not_found', ['model' => __('models/jobs.singular')]));

            return redirect(route('jobs.index'));
        }

        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified Job in storage.
     *
     * @param  int              $id
     * @param UpdateJobRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJobRequest $request)
    {
        /** @var Job $job */
        $job = Job::find($id);

        if (empty($job)) {
            Flash::error(__('messages.not_found', ['model' => __('models/jobs.singular')]));

            return redirect(route('jobs.index'));
        }

        $job->fill($request->all());
        $job->save();

        Flash::success(__('messages.updated', ['model' => __('models/jobs.singular')]));

        return redirect(route('jobs.index'));
    }

    /**
     * Remove the specified Job from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Job $job */
        $job = Job::find($id);

        if (empty($job)) {
            Flash::error(__('messages.not_found', ['model' => __('models/jobs.singular')]));

            return redirect(route('jobs.index'));
        }

        $job->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/jobs.singular')]));

        return redirect(route('jobs.index'));
    }
}
