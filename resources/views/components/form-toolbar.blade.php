<div class="demo-inline-spacing"> 
    {{ $before ?? '' }}
    @if($actionname == 'index')
        @if (UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenname.'.create')) 
            <a class="btn btn-primary float-end"
            href="{{ route($screenname.'.create') }}">
            @lang('crud.add_new')
            </a>
        @endif   
    @endif

    @if($actionname == 'show') 
        @if(isset($key) && $key && UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenname.'.edit'))
            <a class="btn btn-info float-end round"
            href="{{ route($screenname.'.edit',$key) }}">
            @lang('crud.edit')
            </a>
        @endif
        @if (UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenname.'.index'))
            <a class="btn btn-warning float-end round"
                href="{{ route($screenname.'.index') }}">
                @lang('crud.list')
            </a> 
            <a class="btn btn-primary float-end" href="{{ route($screenname.'.index') }}">
                @lang('crud.back')
            </a>
        @endif   
    @endif

    @if($actionname == 'edit')
        @if(isset($key) && $key && UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenname.'.show'))
            <a class="btn btn-info float-end round"
            href="{{ route($screenname.'.show',$key) }}">
            @lang('crud.show')
            </a>
        @endif
        @if (UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenname.'.index'))
             <a class="btn btn-warning float-end round"
                href="{{ route($screenname.'.index') }}">
                @lang('crud.list')
            </a>
        @endif 
       
        @if(isset($key) && $key && UserPermissions::hasAccessTo(str_replace('/', '', Route::current()->getPrefix()).".".$screenname.'.delete'))
            {!! Form::open(['route' => [$screenname.'.destroy', $key], 'method' => 'delete']) !!}
            <div class='btn-group'>
                {!! Form::button(__('crud.delete'), ['type' => 'submit', 'class' => 'btn btn-danger round', 'onclick' => "return confirm('Are you sure?')"]) !!}
            </div>
            {!! Form::close() !!}
        @endif 
        
        {{ $slot }}
      
        {{$after ?? ''}}
        
    @endif
{{--   
        <a class="btn btn-default float-right"
            href="{{ route('cities.index') }}">
            @lang('crud.back')
        </a> --}}

    {{-- <a class="btn btn-primary float-end"
        href="{{ route($screenname.'.create') }}">
        @lang('crud.print')
    </a>

    <a class="btn btn-primary float-end"
        href="{{ route($screenname.'.create') }}">
        @lang('crud.search')
    </a> --}}
</div>