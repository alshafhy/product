@extends('layouts/contentLayoutMaster')

@section('title', 'Invoice Preview')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" href="{{asset('css/base/pages/app-invoice.css')}}">
@endsection

@section('content')
<section class="invoice-preview-wrapper">
  <div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-9 col-md-8 col-12">
      <div class="card invoice-preview-card">
        {{-- <div class="card-body invoice-padding pb-0">
         
          <div class="d-flex justify-content-between flex-md-row flex-column  mt-0">
            <div>
              <div class="logo-wrapper">
                {
                <h3 class="text-primary invoice-logo">تقرير أوامر العمل</h3>
              </div>
            </div>
          </div>
        
        </div> --}}

        {{-- <hr class="invoice-spacing" /> --}}
        <div class="row" style="height:950px;">
            <iframe  src="{{$pdf}}" class="w-full h-screen border-gray-100 border-solid rounded md:flex"/>
              This browser does not support PDFs. Please download the PDF to view it: Download PDF
            </iframe>
        </div>
        
        <!-- Invoice Note ends -->
      </div>
    </div>
    <!-- /Invoice -->

    <!-- Invoice Actions -->
    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
      <div class="card">
        <div class="card-body">
          {{-- <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
            Send Invoice
          </button> --}}
          {{-- <button class="btn btn-outline-secondary w-100 btn-download-invoice mb-75">Download</button> --}}
          <a class="btn btn-outline-secondary w-100 btn-download-invoice mb-75" href="{{url($pdf.'?download=true')}}" target="_blank"> Download </a>
          <a class="btn btn-outline-secondary w-100 mb-75" href="{{url('app/invoice/print')}}" target="_blank"> Print </a>
          {{-- <a class="btn btn-outline-secondary w-100 mb-75" href="{{url($pdf.'?preview=true')}}" target="_blank"> Print </a> --}}
          <a class="btn btn-outline-secondary w-100 mb-75" href="{{url($pdf.'?preview=true')}}" target="_blank"> preview </a>
          {{-- <a class="btn btn-outline-secondary w-100 mb-75" href="{{url('app/invoice/edit')}}"> Edit </a> --}}
          <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#add-payment-sidebar">
            Search
          </button>
        </div>
      </div>
    </div>
    <!-- /Invoice Actions -->
  </div>
</section>

<!-- Send Invoice Sidebar -->
<div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
  <div class="modal-dialog sidebar-lg">
    <div class="modal-content p-0">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">
          <span class="align-middle">Send Invoice</span>
        </h5>
      </div>
      <div class="modal-body flex-grow-1">
        <form>
          <div class="mb-1">
            <label for="invoice-from" class="form-label">From</label>
            <input
              type="text"
              class="form-control"
              id="invoice-from"
              value="shelbyComapny@email.com"
              placeholder="company@email.com"
            />
          </div>
          <div class="mb-1">
            <label for="invoice-to" class="form-label">To</label>
            <input
              type="text"
              class="form-control"
              id="invoice-to"
              value="qConsolidated@email.com"
              placeholder="company@email.com"
            />
          </div>
          <div class="mb-1">
            <label for="invoice-subject" class="form-label">Subject</label>
            <input
              type="text"
              class="form-control"
              id="invoice-subject"
              value="Invoice of purchased Admin Templates"
              placeholder="Invoice regarding goods"
            />
          </div>
          <div class="mb-1">
            <label for="invoice-message" class="form-label">Message</label>
            <textarea
              class="form-control"
              name="invoice-message"
              id="invoice-message"
              cols="3"
              rows="11"
              placeholder="Message..."
            >
Dear Queen Consolidated,

Thank you for your business, always a pleasure to work with you!

We have generated a new invoice in the amount of $95.59

We would appreciate payment of this invoice by 05/11/2019</textarea
            >
          </div>
          <div class="mb-1">
            <span class="badge badge-light-primary">
              <i data-feather="link" class="me-25"></i>
              <span class="align-middle">Invoice Attached</span>
            </span>
          </div>
          <div class="mb-1 d-flex flex-wrap mt-2">
            <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Send Invoice Sidebar -->

<!-- Add Payment Sidebar -->
<div class="modal modal-slide-in fade" id="add-payment-sidebar" aria-hidden="true">
  <div class="modal-dialog sidebar-lg">
    <div class="modal-content p-0">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">
          <span class="align-middle">Add Payment</span>
        </h5>
      </div>
      <div class="modal-body flex-grow-1">
        <form>
          <div class="mb-1">
            <input id="balance" class="form-control" type="text" value="Invoice Balance: 5000.00" disabled />
          </div>
          <div class="mb-1">
            <label class="form-label" for="amount">Payment Amount</label>
            <input id="amount" class="form-control" type="number" placeholder="$1000" />
          </div>
          <div class="mb-1">
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
          </div>
          <div class="d-flex flex-wrap mb-0">
            <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Add Payment Sidebar -->
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
@endsection
