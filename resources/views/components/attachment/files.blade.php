<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <td colspan="4">
                    <button type="button" onclick="addRow()" class="btn btn-icon btn-outline-primary">
                        <i data-feather="plus"></i>
                    </button>
                    {!! Form::hidden('choose_multi_files_allowed', false) !!}
                </td>
            </tr>
            </thead>
            <tbody id="files">
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="text" class="form-control"  name="file_title[]" id="file_title1" placeholder="@lang("attachment.File Title")" @if(in_array("title",$required)) required @endif />
                        <label for="file_title1">@lang("attachment.File Title")</label>
                    </div>
                </td>
                <td>
                    <div class="form-floating">
                        {{-- <x-fileinput-custom name="file[]" :labelTitle="__('attachment.File Name')" ></x-fileinput-custom> --}}
                        <input type="file" name="file[]" class="form-control files" id="file1" placeholder="@lang("attachment.File Name")" accept="{{config('attachment.accept')}}" @if(in_array("file",$required)) required @endif  />
                    </div>
                </td>
                <td>
                    <div class="form-floating">
                        <select class="form-select" onchange="getFileTitle(this,1)" id="file_category1" placeholder="@lang("attachment.File Category")" name="file_category[]" @if(in_array("category",$required)) required @endif>
                            {{-- <option>@lang("attachment.File Category")</option> --}}
                            <option></option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-floating">
                        <textarea class="form-control" name="file_description[]" placeholder="@lang("attachment.File Description")" id="file_description1" rows="3" @if(in_array("description",$required)) required @endif></textarea>
                        <label for="floating-label1">@lang("attachment.File Description")</label>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <style>
        .inputfile {
  /* visibility: hidden etc. wont work */
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile:focus + label {
  /* keyboard navigation */
  outline: 1px dotted #000;
  outline: -webkit-focus-ring-color auto 5px;
}
.inputfile + label * {
  pointer-events: none;
}
    </style>
    @push("page-script")
    <script>
        let _categories = [];
        @foreach($categories as $category)
        _categories.push(
            {
                'id': '{{$category->id}}',
                'title': '{{$category->title}}',
                'description': '{{$category->description}}'
            });
        @endforeach
        function getFileTitle(e,elm_id) {
            let id = e.value;
            if(id != ""){
                for (let i=0; i<_categories.length; i++){
                    if(categories[i].id == id){
                        $("#file_title"+elm_id).val(_categories[i].title);
                        $("#file_description"+elm_id).val(_categories[i].description);
                    }
                }
            }
        }
        function addRow() {
            //let table = document.querySelector("#files");
            let trs = $(".files").length+1;
            let row = '<tr><td><div class="form-floating">\n' +
                '                        <input type="text" class="form-control"  name="file_title[]" id="file_title'+trs+'" placeholder="@lang("attachment.File Title")" />\n' +
                '                        <label for="file_title'+trs+'">@lang("attachment.File Title")</label>\n' +
                '                    </div></td>' +
                '<td><div class="form-floating">\n' +
                // '                        <input type="file" name="file[]" class="form-control files" id="file'+trs+'" placeholder="@lang("attachment.File Name")" accept="{{config('attachment.accept')}}" multiple />\n' +
                '                        <input type="file" name="file[]" class="form-control files" id="file'+trs+'" placeholder="@lang("attachment.File Name")" accept="{{config('attachment.accept')}}"  />\n' +
                '                    </div></td>' +
                '<td><div class="form-floating">\n' +
                '                        <select class="form-select" onchange="getFileTitle(this,'+trs+')" id="file_category'+trs+'" placeholder="@lang("attachment.File Category")" name="file_category[]">\n' +
                '                            <option>@lang("attachment.File Category")</option>\n' +
                '                            @foreach($categories as $category)\n' +
                '                                <option value="{{$category->id}}">{{$category->title}}</option>\n' +
                '                            @endforeach\n' +
                '                        </select>\n' +
                '                    </div></td>' +
                '<td><div class="form-floating">\n' +
                '                        <textarea class="form-control" name="file_description[]" placeholder="@lang("attachment.File Description")" id="file_description'+trs+'" rows="3"></textarea>\n' +
                '                        <label for="floating-label"'+trs+'>@lang("attachment.File Description")</label>\n' +
                '                    </div></td></tr>';
            $("#files").append(row);
        }
    </script>
    @endpush
</div>
