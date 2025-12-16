@extends('layouts.app')

@section('title', __('models/electricalStationsTypes.plural'))

@section('breadcrumbs', __('models/electricalStationsTypes.plural'))

@section('content')
    @include('flash::message')
    <div class="clearfix"></div>
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @include('electrical_stations_types.table')
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bordered table end -->
@endsection




