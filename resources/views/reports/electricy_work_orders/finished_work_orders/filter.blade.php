<form action="" id="search_data" method="post">
    {{-- <div class="mb-1">
      <input id="balance" class="form-control" type="text" value="Invoice Balance: 5000.00" disabled />
    </div>
    <div class="mb-1">
      <label class="form-label" for="amount">Payment Amount</label>
      <input id="amount" class="form-control" type="number" placeholder="$1000" />
    </div> --}}
    @csrf
    <x-report.finished-electricity-filter></x-report.finished-electricity-filter>
    {{-- <div class="mb-1">
        <label class="form-label" for="amount">أمر العمل</label>
        <input id="amount" name="work_order_number" class="form-control" type="number" placeholder="رقم أمر العمل" />
    </div> --}}
    {{-- <div class="mb-1">
      <label class="form-label" for="payment-date">Payment Date</label>
      <input id="payment-date" class="form-control date-picker" type="text" />
    </div>
    <div class="mb-1">
      <label class="form-label" for="payment-method">Payment Method</label>
      <select class="form-select" id="payment-method">
        <option value="" selected disabled>Select payment method</option>
        <option value="Cash">Cash</option>
        <option value="Bank Transfer">Bank Transfer</option>
        <option value="Debit">Debit</option>
        <option value="Credit">Credit</option>
        <option value="Paypal">Paypal</option>
      </select>
    </div>
    <div class="mb-1">
      <label class="form-label" for="payment-note">Internal Payment Note</label>
      <textarea class="form-control" id="payment-note" rows="5" placeholder="Internal Payment Note"></textarea>
    </div> --}}
    <div class="d-flex flex-wrap mb-0">
        {{-- <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button> --}}
        <button id="searchButton" class="btn btn-outline-primary me-1" type="button"> @lang('crud.doSearch') </button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> @lang('crud.cancel')</button>
    </div>
</form>
