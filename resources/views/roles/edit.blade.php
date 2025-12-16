@extends('layouts.app')

@section('title', __('models/roles.plural'))

@section('breadcrumbs', __('models/roles.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/roles.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'roles','action_name' => 'edit'])
            </div>
            
            <div class="card-body">
                <div class="row">
                    @include('roles.fields')
                </div>  
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> الصلاحيات</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12">اختار النظام
                        <select class="form-control" id="object_id" style="width: 50%" data-allow-clear="true" onchange="fetchPermissions(this.value)">
                            <option></option>
                            @foreach($sysScreens as $sysScreen)
                                <option value="{{ $sysScreen->id }}">{{ ($sysScreen->comp_ar_label)?$sysScreen->comp_ar_label :$sysScreen->comp_name }}</option>
                            @endforeach    
                        </select>
                    </div>
                </div>

                <div class="row" id="js-permissions-partial-target"></div>
            </div>

        </div>

    </div>

    <!-- Javascript -->
    <script>
        $(function() {
        /* $('.select2-demo').each(function() {
            $(this)
            .wrap('<div class="position-relative"></div>')
            .select2({
                placeholder: 'اختار',
                dropdownParent: $(this).parent()
            });
        }) */

            $('#object_id').select2({
                placeholder: 'اختار'
            });
        });


        function fetchPermissions(nodeId=null){
            // console.log(nodeId);  
            // var url = (nodeId)? '{{ config('app.url') }}/userManagement/roles/{{ $role->id }}/_permissions/'+nodeId : '{{ config('app.url') }}/userManagement/roles/{{ $role->id }}/_permissions/' ; 
            var url = (nodeId)? '/userManagement/roles/{{ $role->id }}/_permissions/'+nodeId : '{{ config('app.url') }}/userManagement/roles/{{ $role->id }}/_permissions/' ; 

            $.get(url, function(data) {
                $('#js-permissions-partial-target').html(data);
            });
        }
        
        // fetchPermissions();

        // fetchPermissions('020226');
    </script>
    <!-- / Javascript -->



@endsection