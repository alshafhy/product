@extends('layouts.app')

@section('title', __('models/contractors.plural'))

@section('breadcrumbs', __('models/contractors.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/contractors.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'contractors','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('contractors.show_fields')
                </div>
                <x-attachment.file_list
            :model="get_class($contractor)"
            :id="$contractor->id"
            :options="['display'=>['type'=>true]]"
        ></x-attachment.file_list>
            </div>
        </div>
    </div>
@endsection
