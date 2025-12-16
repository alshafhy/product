<div class="row m-1">
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.id')}}</span>: {{$workOrdersProject->id}}
    </div>
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.name')}}</span>: {{$workOrdersProject->name}}
    </div>
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.description')}}</span>: {{$workOrdersProject->description}}
    </div>
</div>

<div class="row m-1">
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.start_date')}}</span>: {{$workOrdersProject->start_date}}
    </div>
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.end_date')}}</span>: {{$workOrdersProject->end_date}}
    </div>
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.status')}}</span>: {{$workOrdersProject->status}}
    </div>
</div>

<div class="row m-1">
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.stages_count')}}</span>: {{$workOrdersProject->stages_count}}
    </div>
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.created_at')}}</span>: <span title="{{$workOrdersProject->created_at}}">{{$workOrdersProject->created_at->toDateString()}}</span>
    </div>
    <div class="col-md-4">
        <span class="fw-bolder text-primary">{{__('models/workOrdersProjects.fields.updated_at')}}</span>: <span title="{{$workOrdersProject->updated_at}}">{{$workOrdersProject->updated_at->toDateString()}}</span>
    </div>
</div>



