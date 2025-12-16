<div>
    {!! Form::open(['route' => [$screenName.'.destroy', $rowID], 'method' => 'delete']) !!}
        <div class='btn-group'>
            @if (isset($buttons))
            
                @if (in_array("show", $buttons) && UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenName.'.show'))
                    <a href="{{ route($screenName.'.show', $rowID) }}" class='btn btn-outline-primary btn-sm'>
                        <i data-feather="eye"></i>
                    </a>
                @endif

                @if (in_array("edit", $buttons) && UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenName.'.edit'))
                    <a href="{{ route($screenName.'.edit', $rowID) }}" class='btn btn-outline-warning btn-sm'>
                        <i data-feather="edit"></i>
                    </a>
                @endif

                @if (in_array("delete", $buttons) && UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenName.'.delete'))
                    {!! Form::button('<i data-feather="trash"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-outline-danger btn-sm',
                        'onclick' => 'return confirm("'.__('crud.are_you_sure_to_delete_this_row').'")'
                    ]) !!}
                @endif
            @endif
        
        </div>
    {!! Form::close() !!}
</div>

{{-- @hasrole('admin')
{!! Form::button('<i data-feather="trash"></i>', [
    'type' => 'submit',
    'class' => 'btn btn-outline-danger btn-sm',
    'onclick' => 'return confirm("'.__('crud.are_you_sure_to_delete_this_row').'")'
]) !!}
@else
@can(str_replace('/', '', Route::current()->getPrefix()).".".$screenName.'.delete')
    {!! Form::button('<i data-feather="trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-outline-danger btn-sm',
        'onclick' => 'return confirm("'.__('crud.are_you_sure_to_delete_this_row').'")'
    ]) !!}
@endcan
@endhasrole --}}

  {{-- @else
                    {!! Form::button('<i data-feather="trash"></i>', [
                        'type' => 'button',
                        'class' => 'btn btn-outline-danger btn-sm',
                        'disabled' =>'disabled',
                        'onclick' => 'return confirm("'.__('crud.are_you_sure_to_delete_this_row').'")'
                    ]) !!} --}}



 {{-- <div class="dropdown"> --}}
    {{-- <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
        <i data-feather="more-vertical"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-end">
        @if (in_array("show", $buttons))
            <a href="{{ route($screenName.'.show', $rowID) }}" class='dropdown-item'>
                <i data-feather="eye" class="me-50"></i>
                <span>عرض</span>
            </a>
        @endif
        @if (in_array("edit", $buttons))
            <a href="{{ route($screenName.'.edit', $rowID) }}" class='dropdown-item'>
                <i data-feather="edit-2" class="me-50"></i>
                <span>تعديل</span>
            </a>
        @endif
        {!! Form::open(['route' => [$screenName.'.destroy', $rowID], 'method' => 'delete']) !!}
            @if (in_array("delete", $buttons))
                {!! Form::button('<i data-feather="trash" class="me-50"></i>
                    <span>حذف</span>', [
                    'type' => 'submit',
                    'class' => 'dropdown-item w-100',
                    'onclick' => 'return confirm("'.__('crud.are_you_sure_to_delete_this_row').'")'
                    ]) 
                !!}
            @endif
        {!! Form::close() !!} 
      </div> --}}
    {{-- </div> --}}