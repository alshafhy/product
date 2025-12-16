<div>
    <div class="form-group {{$divContainerClass}}">
        <label for="file_category" class="form-label">@lang("attachment.File Category")</label>
        <select class="form-select" onchange="_getFileTitle(this)" id="file_category" name="file_category" @if(in_array("category",$required)) required @endif>
            <option></option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group {{$divContainerClass}} ">
        <label for="file_title" class="form-label">@lang("attachment.File Title")</label>
        <input type="text" name="file_title"  class="form-control" id="file_title" @if(in_array("title",$required)) required @endif>
    </div>

    {{-- <div class="form-group {{$divContainerClass}}">
        <label for="file" class="form-label">@lang("attachment.File Name")</label>
        <input class="form-control" type="file" id="file"  name="file" accept="{{config('attachment.accept')}}" @if(in_array("file",$required)) required @endif>
    </div> --}}

    <div class="form-group {{$divContainerClass}}">
        {!! Form::hidden('choose_multi_files_allowed', true) !!}
        <x-fileinput-custom name="file[]" :labelTitle="__('attachment.File Name')" ></x-fileinput-custom>
    </div>

    <div class="form-group {{$divContainerClass}}">
        <label for="file_description" class="form-label">@lang("attachment.File Description")</label>
        <textarea class="form-control" name="file_description" id="file_description" rows="3" @if(in_array("description",$required)) required @endif></textarea>
    </div>
    @push('page-script')
    <script>
        let categories = [];
        @foreach($categories as $category)
            categories.push(
                {
                    'id': '{{$category->id}}',
                    'title': '{{$category->title}}',
                    'description': '{{$category->description}}'
                });
        @endforeach
        function _getFileTitle(e) {
            let id = e.value;
            if(id != ""){
                for (let i=0; i<categories.length; i++){
                    if(categories[i].id == id){
                        $("#file_title").val(categories[i].title);
                        $("#file_description").val(categories[i].description);
                    }
                }
            }
        }
    </script>
    @endpush
</div>
