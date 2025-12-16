@extends('layouts/fullLayoutMaster')

@section('title', 'الطباعة')

@section('page-style')
  <!-- vendor css files -->
  <style type="text/css">
    table { page-break-inside:auto ;}
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
</style>
@endsection

@section('content')
{{-- <div class="row">
    <div class="col-12 p-4"> --}}
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
                        <td>{!! $value !!}</td>
                    @else
                        <td></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
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

  