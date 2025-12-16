@if (isset($emergencyMission))
<div class="tab-pane" id="attachment" aria-labelledby="attachment-tab" role="tabpanel" >
    <!-- Needs Drilling Operations Field -->
    <div class="card">
        <div class="card-header">
            {{-- <h4 class="card-title">{{  __('models/emergencyMissions.attachments') }}   </h4> --}}
            {{-- <a class="btn btn-primary float-end" href="#"> @lang('crud.add_new') </a> --}}
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary pull-right" data-bs-toggle="modal" data-bs-target="#inlineForm">
                {{  __('models/emergencyMissions.add_new_attachment') }}
            </button>
                &nbsp;
            <button type="button" class="btn btn-outline-info float-end" data-bs-toggle="modal" data-bs-target="#inlineMForm">
                {{  __('models/workOrders.add_new_multi_attachment') }}
            </button>


        </div>
        <div class="card-body">
            <div class="row">

                <!-- <div class="form-group col-sm-6"></div> -->
                @if ($emergencyMission)
                    <x-attachment.file_list :model="get_class($emergencyMission)" :id="$emergencyMission->id" :options="['display'=>['type'=>true]]"></x-attachment.file_list>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endif
