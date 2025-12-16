
@extends('layouts/contentLayoutMaster')

@section('title', 'Form Repeater')

@section('content')
<section class="form-control-repeater">
  <div class="row">
    <!-- Invoice repeater -->
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Invoice</h4>
        </div>
        <div class="card-body">
          <form action="#" method="POST" >
            @csrf
            
            <x-form-repeater name="invoices" :options="$invoiceDetilsOptions"/>
          </br></br></br>
            <button type="submit">حفظ</button>
          </form>
        </div>
      </div>
    </div>
    <!-- /Invoice repeater -->
  </div>
</section>
@endsection
@section('page-script')

  <script>
  function _CalTotal3(params) {
    console.log("i am here3");
  }
  </script>
@endsection

