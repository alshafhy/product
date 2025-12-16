@extends('layouts/fullLayoutMaster')

@section('title', 'الطباعة')

@section('page-style')
  <!-- vendor css files -->
  <style type="text/css">
    table { page-break-inside:auto ;}
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
   
    @media print {
        @page {
                size: landscape;
            }

        page{
                display: block;
                /* margin-header: 1%;
                margin-footer: 1%; */
                margin-right: 1%;
                margin-left: 1%;
                margin-top: 15mm;
            }
       
        body {
            zoom: {{request()->request->all()['reportZoom'] ?? '100%'}}; 
        }
        
    }
</style>
@endsection

@section('content')
{{-- <div class="row">
    <div class="col-12 p-4"> --}}
        
        {{-- <htmlpageheader name="page-header" >
           <br><br><br>
        </htmlpageheader> --}}
        {{-- <pagefooter name="MyFooter1" content-center="test 1" content-right="{nbpg}/{PAGENO}" footer-style=" font-size: 12pt; color: #000000;background-color: red ;  " /> --}}
         
      
      
         
<page >
    {{-- <page size="A4"> --}}
        {{-- {{dd(request()->request->all()['reportTitle'] )}} --}}
        @if (request()->request->all()['reportTitle'])
            <h2>{{__('print.'.request()->request->all()['reportTitle'])}}</h2>
        @endif
    <table class="table table-striped table-bordered">
        @foreach($data as $row)
            @if ($loop->first)
                <tr style="font-size: 11px;">
                    @foreach($row as $key => $value)
                        <th>{!! $key !!}</th>
                    @endforeach
                </tr>
            @endif
            <tr style="font-size: 10px;">
                @foreach($row as $key => $value)
                    @if(is_string($value) || is_numeric($value))
                        <td style="white-space: nowrap;">{!! $value !!}</td>
                    @else
                        <td></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</page>
    
{{-- </div>
</div> --}}
@endsection


@section('page-script')
<script>
    // b=function(){g.autoPrint&&(f.print(),f.close())};
    $(function () {
         window.print();
         window.onafterprint = back;

        function back() {
            window.history.back();
        }
  });
    </script>

@endsection

  