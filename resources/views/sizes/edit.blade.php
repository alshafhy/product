@extends('layouts.app')

@section('title', 'Sizes')

@section('breadcrumbs', 'Sizes')

@section('content')
<div class="content-body">
    <section class="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Size</h4>
                        @include('layouts.partials.form_toolbar', ['screen_name' => 'sizes','action_name' => 'edit'])
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {!! Form::model($size, ['route' => ['sizes.update', $size->id], 'method' => 'patch']) !!}

                            <div class="row">
                                @include('sizes.fields')
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ route('sizes.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection