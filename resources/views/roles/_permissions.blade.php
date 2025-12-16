{!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch' , 'id' => 'permssions-frm']) !!}
<table class="table table-borderless">
    <tbody>
        {{ Form::hidden('objectId', $objectId) }}
        @foreach($nodes as $node)
        <tr>
            <td>
                {{ ($node->comp_ar_label)?$node->comp_ar_label :$node->comp_name }}::({{ $node->route_name }}) 
            </td> 
            @foreach($permission as $value)
                @if ($value->system_component_id == $node->id)
                <td>
                    <div class="custom-control custom-checkbox">
                        <label class="custom-control custom-checkbox">
                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false , array('class' => 'custom-control-input')) }}
                            <span class="custom-control-label">
                                {{ App\Utils\PermissionsUtil::generatePermLabel($value->name) }}
                            </span>
                        </label>
                    </div>
                </td>
                @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('roles.index') }}" class="btn btn-default">
        @lang('crud.cancel')
     </a>
</div>

{!! Form::close() !!}

