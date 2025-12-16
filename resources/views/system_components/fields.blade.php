<!-- Comp Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comp_name', __('models/systemComponents.fields.comp_name').':') !!}
    {!! Form::text('comp_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Comp Ar Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comp_ar_label', __('models/systemComponents.fields.comp_ar_label').':') !!}
    {!! Form::text('comp_ar_label', null, ['class' => 'form-control']) !!}
</div><!-- Comp Ar Label Field -->

<!-- Comp Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comp_type', __('models/systemComponents.fields.comp_type').':') !!}
    {{ Form::select('comp_type', $comp_type_list, isset($systemComponent->comp_type) ? $systemComponent->comp_type : '', ['id' => 'parent_id','class' => 'select2 form-select select2-hidden-accessible']) }}
</div>

<!-- Route Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('route_name', __('models/systemComponents.fields.route_name').':') !!}
    {!! Form::text('route_name', null, ['class' => 'form-control']) !!}
</div>

<!-- prefix Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prefix', __('models/systemComponents.fields.prefix').':') !!}
    {!! Form::text('prefix', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    <div class="select2-primary">
    {!! Form::label('parent_id', __('models/systemComponents.fields.parent_id').':') !!}
    {{ Form::select('parent_id', $parents_list,  isset($systemComponent->parent_id) ? $systemComponent->parent_id : '', ['id' => 'parent_id','class' => 'select2 form-select select2-hidden-accessible']) }}
    </div>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('icon_name', __('models/systemComponents.fields.icon_name').':') !!}
    {!! Form::text('icon_name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/systemComponents.fields.description').':') !!}
    {!! Form::text('description', null, ['id'=>'description','class' => 'form-control','style'=>'']) !!}
</div>

<div class="form-group col-sm-12">
    <code class="prettyprint">
        var configExample = {
            "reportTemplate": "",
            "reportFilterTemplate": "",
            "font_name": "calibri",
            "font_size": "11",
            "title_background_color": "4CAF50",
            "orientation": "L",
            "reportButtons": [
                "view",
                "print",
                "download",
                "search"
            ]
        }
    </code>
    <br>
    {!! Form::label('config', __('models/systemComponents.fields.config').':') !!}
    {!! Form::textArea('config', null, ['id'=>'myText','class' => 'form-control','style'=>'direction: ltr;']) !!}
</div>
<style>

textarea {
  width: 100%;
  min-height: 30rem;
  font-family: "Lucida Console", Monaco, monospace;
  font-size: 0.8rem;
  line-height: 1.2;
}
</style>
<script>
    // var data = json document.getElementById("myText").innerHTML;

    // document.getElementById("myText").innerHTML = JSON.stringify(data, null, 4);
    
  </script>
