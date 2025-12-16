@extends('layouts.app')
@section('title', __('models/systemReleases.plural'))

@section('breadcrumbs', __('models/systemReleases.plural'))
@section('content')
    @include('flash::message')
    <div class="clearfix"></div>
    <!-- Bordered table start -->
    @foreach ($releases as $release)
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <h4 class="text-primary"><span class="caption-subject font-blue-madison bold uppercase"> الإصدار رقم
                                {{ $release->version_number }} -
                                 تاريخ الاصدار {{ \Carbon\Carbon::parse($release->release_date)->format('d/m/Y') }} 
                            </span>  </h4>
                            <ul class="font-green mt-2">
                                @foreach ($release->features as $feature)
                                    <li >{{ $feature->title }}</li>
                                @endforeach
                            </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Bordered table end -->
@endsection
