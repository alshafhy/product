<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
             {{  __('models/employees.fields.id').' :' }}
        </div>
        <div class="col-sm-9 ">
            # {{ $employee->id }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{ __('models/employees.fields.name').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $employee->name }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
             {{  __('models/employees.fields.branch_id').' :' }}
        </div>
        <div class="col-sm-9">
            {{ '['.$employee->branch_id. '] - '.$employee->branch->name }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{ __('models/employees.fields.department_id').' :' }}
        </div>
        <div class="col-sm-9">
            {{ '['.$employee->department_id .'] - '.$employee->department->name }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
             {{  __('models/employees.fields.job_id').' :' }}
        </div>
        <div class="col-sm-9">
            {{ '['.$employee->job_id. '] - '.$employee->job->name }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{ __('models/employees.fields.user_id').' :' }}
        </div>
        <div class="col-sm-9">
            {{ '['.$employee->user_id.'] - '.$employee->user->name }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
             {{  __('models/employees.fields.created_at').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $employee->created_at }}
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder">
            {{ __('models/employees.fields.updated_at').' :' }}
        </div>
        <div class="col-sm-9">
            {{ $employee->updated_at }}
        </div>
    </div>
</div>

