
<x-datatable-actions :screenName="$screen_name" :rowID="$id" ></x-datatable-actions>

{{-- {!! Form::open(['route' => [$screen_name.'.destroy', $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        @if (isset($buttonsArray))
            
        @endif
        <a href="{{ route($screen_name.'.show', $id) }}" class='btn btn-outline-primary btn-sm'>
            <i data-feather="eye"></i>
        </a>
        <a href="{{ route($screen_name.'.edit', $id) }}" class='btn btn-outline-warning btn-sm'>
            <i data-feather="edit"></i>
        </a>
        {!! Form::button('<i data-feather="trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-outline-danger btn-sm',
            'onclick' => 'return confirm("'.__('crud.are_you_sure_to_delete_this_row').'")'
        ]) !!}
    </div>
{!! Form::close() !!} --}}

