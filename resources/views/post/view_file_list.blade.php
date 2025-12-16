@extends('layouts.contentLayoutMaster')

@section('title', 'View Post')
@section('content')
<div class="col-12">
    <div class="card">

        <div class="card-body">
            <h4 class="card-title">{{$post->title}}</h4>
            <p class="card-text mb-2">
                {{$post->body}}
            </p>
        </div>
        <hr>
 hr     <x-attachment.file_list
            :model="get_class($post)"
            :id="$post->id"
            :options="['display'=>['type'=>true]]"
        ></x-attachment.file_list>
    </div>
</div>

@endsection
