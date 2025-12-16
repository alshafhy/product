@extends('layouts/reportsLayout')

@section('title',$report->comp_ar_label)

@section('breadcrumbs', __('reports'))

@section('report')
  <div class="row" style="height:950px;">
      <iframe  src="{{route($reportRouteName)}}" class="w-full h-screen border-gray-100 border-solid rounded md:flex"/>
        This browser does not support PDFs. Please download the PDF to view it: Download PDF
      </iframe>
  </div>
@endsection

@section('reportButtons')
  {{-- {{dd( $report->getReportButtonsArray())}} --}}
  @if (in_array("view", $report->getReportButtonsArray()))
    <a class="btn btn-outline-secondary w-100 mb-75" href="{{route($reportRouteName)}}?preview=true" target="_blank"> {{__('print.preview')}}  </a>
  @endif
  @if (in_array("download", $report->getReportButtonsArray()))
  <a class="btn btn-outline-secondary w-100 btn-download-invoice mb-75" href="{{route($reportRouteName)}}?download=true" target="_blank">
      {{__('print.Download PDF')}} </a>
  @endif
  {{-- <a class="btn btn-outline-secondary w-100 mb-75" href="{{route($reportRouteName)}}?print=true" target="_blank"> {{__('print.print')}} </a> --}}
  @if (in_array("save", $report->getReportButtonsArray()))
    <a class="btn btn-outline-secondary w-100 mb-75" href="{{route($reportRouteName)}}?save=true" target="_blank"> {{__('print.save and generate link')}} </a>
    {{-- <a class="btn btn-outline-secondary w-100 mb-75" href="{{url($pdf.'?preview=true')}}" target="_blank"> Print </a> --}}
  @endif
  {{-- <a class="btn btn-outline-secondary w-100 mb-75" href="{{url('app/invoice/edit')}}"> Edit </a> --}}
  @if (in_array("search", $report->getReportButtonsArray()))
    <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#add-payment-sidebar">
        {{__('print.search')}}
    </button>
  @endif
@endsection
@section('reportSearch')
    @include($report->getConfig()['reportFilterTemplate'])
@endsection


@push('page-script')

    <script type="text/javascript">
        $(function () {

          //var table = $('.data-table').DataTable();
          $(".search").keyup(function(){
            search();
          });

          $("#searchButton").click(function(){
            search();
          });
        });

        function search() {
            var $form = $("#search_data");
            var data = getFormData($form);
            console.log(data);
            console.log(JSON.stringify(data));
            jsonData = {'searchData':data};
            console.log(jsonData);
            $("#search_data").submit();
            //table.search( JSON.stringify(jsonData) ).draw();
            //   table.search( {'status':this.value} ).draw();
            //$('input[type="search"]').val('');
        }

        function getFormData($form){
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }
      </script>

@endpush

