@extends('layouts.app')

@section('title', __('models/baladies.plural'))

@section('breadcrumbs', __('models/baladies.plural'))

@section('content')
    @include('flash::message')
    <div class="clearfix"></div>
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h4 class="card-title"> @lang('models/baladies.plural')</h4>
                    @include('layouts.partials.form_toolbar', ['screen_name' => 'baladies','action_name' => 'index']) --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @include('baladies.table')
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bordered table end -->
@endsection




