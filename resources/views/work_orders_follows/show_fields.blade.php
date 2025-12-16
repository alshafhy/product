<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/workOrderFollows.fields.id').':') !!}
    <p>{{ $workOrderFollow->id }}</p>
</div>

<!-- Work Order Number Field -->
<div class="col-sm-12">
    {!! Form::label('work_order_number', __('models/workOrderFollows.fields.work_order_number').':') !!}
    <p>{{ $workOrderFollow->work_order_number }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/workOrderFollows.fields.created_at').':') !!}
    <p>{{ $workOrderFollow->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/workOrderFollows.fields.updated_at').':') !!}
    <p>{{ $workOrderFollow->updated_at }}</p>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
            <th>{{('#')}}</th>
            <th>النوع</th>
            <th>الطبقة</th>
            <th>نتيجة المختبر</th>
            <th>سبب الرسوب</th>
            <th>المضيف</th>
        </tr>
        </thead>
        <tbody id="layers_table">
        @if(($workOrderFollow->landLayersHistory))
            @foreach($workOrderFollow->landLayersHistory as $landLayer)
                <tr id="tr{{$landLayer->id}}">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td id="event_type{{ $landLayer->id }}">
                        @if($landLayer->event_type=="created")
                            إضافة
                        @else
                            تعديل
                        @endif
                    </td>
                    <td id="name{{ $landLayer->id }}">{{$landLayer->layer->name}}</td>
                    <td id="lab_result_status{{ $landLayer->id }}">{{$labResultStatusList[$landLayer->lab_result_status]}}</td>
                    <td id="note{{ $landLayer->id }}">{{$landLayer->note}}</td>
                    <td id="user{{ $landLayer->id }}">{{$landLayer->user->name}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
