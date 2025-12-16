<div>
    {{-- {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!} --}}
    {!! Form::hidden('redirectAction', "index", ["id"=>"redirectAction"]) !!}
    @if ($action=='create')
    <button type="button" class="btn btn-primary" onclick="doSubmit(this,2)" >{{__('crud.saveAndGoToEdit'),}}</button>
    @else
    <button type="button" class="btn btn-primary" onclick="doSubmit(this,2)" >{{__('crud.saveAndEdit'),}}</button>
    @endif
    
    <button type="button" class="btn btn-primary" onclick="doSubmit(this,1)" >{{__('crud.saveAndClose'),}}</button>
   
    <a href="{{ route($cancelroute) }}" class="btn btn-default">
        @lang('crud.cancel')
    </a>

</div>



<script>

    function doSubmit(e,type) {
        if(type == 2){
            $('#redirectAction').val("edit")
        }
        $(e).closest('form').submit();
    }
</script>
