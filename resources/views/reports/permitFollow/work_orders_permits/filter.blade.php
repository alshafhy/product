<form action="" id="search_data" method="post">
    @csrf
    <x-report.work-orders-permits-filter></x-report.work-orders-permits-filter>

    <div class="d-flex flex-wrap mb-0">
        {{-- <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button> --}}
        <button id="searchButton" class="btn btn-outline-primary me-1" type="button"> @lang('crud.doSearch') </button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> @lang('crud.cancel')</button>
    </div>
</form>
