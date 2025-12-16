@extends('layouts.app')

@section('title', 'Colors')

@section('breadcrumbs', 'Colors')

@section('content')
<div class="content-body">
    <section class="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Color</h4>
                        @include('layouts.partials.form_toolbar', ['screen_name' => 'colors','action_name' => 'create'])
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {!! Form::open(['route' => 'colors.store']) !!}

                            <div class="row">
                                @include('colors.fields')
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ route('colors.index') }}" class="btn btn-secondary">Cancel</a>
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