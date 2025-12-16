<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/employees.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Branch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', __('models/employees.fields.branch_id').':') !!}
    {!! Form::select('branch_id', $branches ,null, ['class' => 'select2 form-select form-control']) !!}
</div>

<!-- Department Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_id', __('models/employees.fields.department_id').':') !!}
    {!! Form::select('department_id', $departments ,null, ['class' => 'select2 form-select form-control']) !!}
</div>

<!-- Job Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_id', __('models/employees.fields.job_id').':') !!}
    {!! Form::select('job_id', $jobs ,null, ['class' => 'select2 form-select form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/employees.fields.user_id').':') !!}
    {!! Form::select('user_id', $user??[] ,null, ['class' => 'select2 form-select form-control']) !!}
</div>
@section("page-script")
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $('#user_id').select2({
            minimumInputLength: 2,
            ajax: {
                type: "post",
                url: '{{route("users.api")}}',
                dataType: 'json',
                //delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>
@endsection
