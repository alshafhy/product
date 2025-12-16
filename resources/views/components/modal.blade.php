<!-- start  modal -->
<div class="modal fade" id="{{$mode ?? ''}}_{{$modal ?? ''}}_modal" tabindex="-1" aria-labelledby="{{ $modal }}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
          <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div id="{{$modal ?? ''}}_errors" class="error" style="padding: 10px"></div>

          <div class="modal-body pb-5 px-sm-4 mx-50">

            {{ $slot }}
          
          </div>
      </div>
  </div>
</div>
<!-- end modal -->
