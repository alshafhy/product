@extends('layouts.app')

@section('title', __('models/workOrders.plural_'))

@section('breadcrumbs', __('models/workOrders.parent_menu_'))

@section('content')
    
    <div>

        {{-- @include('layouts.partials.messages') --}}
        <div class="card">

            {{-- {!! Form::open(['route' => 'workOrders.store']) !!} --}}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrders.plural') }} - @lang('crud.add_new')  </h4>
                

            </div>
             
            <div class="card-body">
                <div class="row" style="width: 850px;height:950px;">
                  {{-- test
                  <object data="{{$pdf}}" type=”application/pdf” width=”100%” height=”100%”>

                    Example fallback content: This browser does not support PDFs. Please download the PDF to view it: Download PDF.
                    
                    </object>
                  <embed src="{{$pdf}}" type=”application/pdf” width=”100%” height=”100%”> --}}

                    <iframe  src="{{$pdf}}" class="w-full h-screen border-gray-100 border-solid rounded md:flex"/>
                  {{-- <iframe src="{{$pdf}}" width=”100%” height=”100%”> --}}

                    This browser does not support PDFs. Please download the PDF to view it: Download PDF
                    
                    </iframe>
                </div>
            </div>

            {{-- <div class="card-footer">
                <x-form-submit-buttons screenname="workOrders" cancelroute="workOrders.index"></x-form-submit-buttons>
            </div> --}}

            {{-- {!! Form::close() !!} --}}

        </div>
    </div>
@endsection
