
<label for="{{$name}}" class="form-label">{{$labelTitle}}</label>
<div class="fileinput fileinput-new input-group" data-provides="fileinput">
    <div class="form-control" data-trigger="fileinput" style="margin-left:5px;">
    <span class="fileinput-filename "></span>
    </div>
    <span class="input-group-append">
    <span class="input-group-text fileinput-exists btn btn-outline-primary" data-dismiss="fileinput">
        حذف الملف
    </span>

    <span class="input-group-text btn-file btn btn-outline-primary">
        <span class="fileinput-new ">أختار الملف</span>
        <span class="fileinput-exists ">تغيير</span>
        <input type="file" name="{{$name}}" multiple>
    </span>
    </span>
</div>
