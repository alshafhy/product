@extends('layouts.contentLayoutMaster')

@section('title', 'Create Post')
@php
    $categories  = \App\Models\AttachmentType::get();
@endphp
@section('content')
    <form name="posts" action="{{route("post_store")}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="mb-3">
            <label for="title" class="form-label">@lang("Title")</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">@lang("Description")</label>
            <textarea class="form-control" name="body" id="body" rows="3" required></textarea>
        </div>

    <x-attachment.file
        required="title,file,category"
        :categories="$categories"
    ></x-attachment.file>

        <button type="submit" class="btn btn-primary">Send</button>
    </form>
@endsection
