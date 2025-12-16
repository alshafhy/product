{{-- <!-- {{ $fieldTitle }} Field -->
<div class="col-sm-12">
@if($config->options->localized)
    @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':') !!}
@else
    @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:') !!}
@endif
    <p>@{{ ${!! $config->modelNames->camel !!}->{!! $fieldName !!} }}</p>
</div> --}}

<!-- {{ $fieldTitle }} Field -->
<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3 fw-bolder bold">{{-- {{  __('models/employees.fields.id').' :' }} --}}
        @if($config->options->localized)
        @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':') !!}
        @else
        @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:') !!}
        @endif
        </div>
        <div class="col-sm-9 ">
            <p>@{{ ${!! $config->modelNames->camel !!}->{!! $fieldName !!} }}</p>
        </div>
    </div>
</div>