@if($errors->any())
    @include('layouts.partials.errors')
@else
    @include('flash::message')
@endif



{{-- 
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-block alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    Check the following errors :
    <br>
    <ul class="alert alert-danger" style="list-style-type: none">
        @foreach($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
</div>
@endif --}}
