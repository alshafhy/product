<div class="tab-pane" id="attachment" aria-labelledby="attachment-tab" role="tabpanel" >
    <!-- Needs Drilling Operations Field -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{  __('models/workOrders.attachments') }}   </h4>
            {{-- <a class="btn btn-primary float-end" href="#"> @lang('crud.add_new') </a> --}}
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#inlineForm">
                {{  __('models/workOrders.add_new_attachment') }}
            </button>
                &nbsp;
            <button type="button" class="btn btn-outline-info float-end" data-bs-toggle="modal" data-bs-target="#inlineMForm">
                {{  __('models/workOrders.add_new_multi_attachment') }}
            </button>


        </div>
        <div class="card-body">
            <div class="row">

                <!-- <div class="form-group col-sm-6"></div> -->
                <x-attachment.file_list :model="get_class($workOrder)" :id="$workOrder->id" :options="['display'=>['type'=>true]]"></x-attachment.file_list>
            </div>
        </div>
    </div>
</div>
