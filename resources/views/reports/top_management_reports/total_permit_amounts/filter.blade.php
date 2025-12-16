<form action="" id="search_data" method="post">

    @csrf
    <x-report.total-permit-amounts-filter></x-report.total-permit-amounts-filter>

    <div class="d-flex flex-wrap mb-0">
        <button id="searchButton" class="btn btn-outline-primary me-1" type="button"> @lang('crud.doSearch') </button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> @lang('crud.cancel')</button>
    </div>
</form>
