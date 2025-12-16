@extends('layouts.app')

@section('title', __('models/items.plural'))

@section('breadcrumbs', __('models/items.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($item, ['route' => ['items.update', $item->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/items.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'items','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('items.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('items.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection