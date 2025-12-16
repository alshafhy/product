@section("page-style")
<link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-toastr.css')}}">
  <style>
    #map,#map1 {
                  height: 100%;
                  margin: 15px 15px 15px 15px;
              }
  </style>
@endsection
@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/css/extensions/toastr.min.css')}}">
@endsection


<div class="tab-pane" id="location" aria-labelledby="map-tab" role="tabpanel" style="height: 700px;margin: 14px;">
  <p>
    <h3 class="block">موقع أمر العمل :</h3>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{!! Form::label('share_link', __('models/workOrders.fields.shareLink').':') !!}</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-3 col-md-4 col-sm-6 col-12 pe-sm-0">
                <div class="mb-1" id="share_link_div" >
                  {{-- <input type="text" class="form-control" id="copy-to-clipboard-input" value="Copy Me!" /> --}}
                  
                   {!! Form::text('share_link', null, ['class' => 'form-control', 'readonly'=> 'readonly', 'style'=>'direction:ltr', 'onclick'=>'copyShareLink()']) !!}
                  {{-- {!! Form::text('share_link', null, ['class' => 'form-control', 'readonly'=> 'readonly', 'style'=>'direction:ltr']) !!} --}}
                </div>
              </div>
              <div class="col-sm-2 col-12">
                <button type="button" class="btn btn-outline-primary" id="btn-copy">نسخ</button>
              </div>
            </div>
            <div class="row">
              <!-- X Axis Field -->
              <div class="form-group col-sm-6">
                  {!! Form::label('x_axis', __('models/workOrders.fields.x_axis')) !!}
                  {!! Form::text('x_axis', null, ['class' => 'form-control', 'readonly'=> 'readonly']) !!}
              </div>
      
              <!-- Y Axis Field -->
              <div class="form-group col-sm-6">
                  {!! Form::label('y_axis', __('models/workOrders.fields.y_axis')) !!}
                  {!! Form::text('y_axis', null, ['class' => 'form-control', 'readonly'=> 'readonly']) !!}
              </div>
            </div>
            {{-- <div class="row">
              <div class="form-group col-sm-6">
                <h3 class="block">UTM </h3>
              </div>
            </div> --}}
            <div class="row">
              <!-- X Axis Field -->
              <div class="form-group col-sm-6">
                  {!! Form::label('utm_easting', __('models/workOrders.fields.utm_easting')) !!}
                  {!! Form::text('utm_easting', null, ['class' => 'form-control']) !!}
              </div>
      
              <!-- Y Axis Field -->
              <div class="form-group col-sm-6">
                  {!! Form::label('utm_northing', __('models/workOrders.fields.utm_northing')) !!}
                  {!! Form::text('utm_northing', null, ['class' => 'form-control']) !!}
              </div>
            </div>
            <div class="row" id="mapDiv" style="height: 400px">
              <div class="col-md-12">
                  {{-- <input type="hidden" name="x_axis" value="" id="x_axis"> --}}
                  {{-- <input type="hidden" name="y_axis" value=""id="y_axis"> --}}
                  
                  <div id="map" style="margin-bottom:10px"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </p>
     
</div>

 @section('vendor-script')
  <script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endsection

{{-- @section("page-script") --}}
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/map.js')) }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBy0IjPQRaFVvb6QljJSEVKNM_8i2zapzo&callback=initMap">
</script>
@endsection
{{-- @endsection --}}
