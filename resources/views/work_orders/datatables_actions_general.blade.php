{{-- @include('layouts.partials.datatables_actions', [
    'screen_name' => collect(explode(".",Route::currentRouteName()))->first()
    ]) --}}
{{-- 
@if ($status == 1)
<x-datatable-actions :screenName="collect(explode('.',Route::currentRouteName()))->first()" :rowID="$id" :buttons="['show','edit','delete']"></x-datatable-actions>

@else
<x-datatable-actions :screenName="collect(explode('.',Route::currentRouteName()))->first()" :rowID="$id" :buttons="['show','edit']"></x-datatable-actions>

@endif --}}
{{-- {{$actionVisible}} --}}
<x-datatable-actions :screenName="collect(explode('.',Route::currentRouteName()))->first()" :rowID="$id" ></x-datatable-actions>