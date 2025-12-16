<div class="form-modal-ex">
    <!-- Modal -->
    <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">رفع ملف / ملفات مرفق جديد</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          {!! Form::model($workOrder, ['route' => ['workOrders.update_attachment', $workOrder->id], 'method' => 'post', 'files' => true]) !!}
            <div class="modal-body">
                <x-attachment.file required="file,category" divContainerClass="mb-1" ></x-attachment.file>
              {{-- <label>Email: </label> --}}
              {{-- <div class="mb-1">
                <input type="text" placeholder="Email Address" class="form-control" />
              </div>

              <label>Password: </label>
              <div class="mb-1">
                <input type="password" placeholder="Password" class="form-control" />
              </div> --}}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{__('crud.save')}}</button>
              <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">{{__('crud.cancel')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<!-- End Modal -->
<div class="form-modal-ex">
    <!-- Modal -->
    <div class="modal fade text-start" id="inlineMForm" tabindex="-1" aria-labelledby="myModalLabelM33" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabelM33">رفع ملف / ملفات مرفق جديد</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::model($workOrder, ['route' => ['workOrders.update_attachment', $workOrder->id], 'method' => 'post', 'files' => true]) !!}
                <div class="modal-body">
                    <x-attachment.files required="file,category" divContainerClass="mb-1" ></x-attachment.files>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('crud.save')}}</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">{{__('crud.cancel')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
