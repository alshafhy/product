<div>
    <div class="table-responsive">
        <table class="table table-bordered" id="cities-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang("activity_log.Description")</th>
                <th>@lang("activity_log.Event")</th>
                <th>@lang("activity_log.Causer")</th>
                <th>@lang("activity_log.Created")</th>
                <th class="text-center">@lang("activity_log.Show")</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activities as $activity)
                @php if(!is_null($activity->causer_type)){
                    $model = new $activity->causer_type;
                    $item = $model::find($activity->causer_id);
                }else{
                    $activity->causer_type = '-';
                    $activity->causer_id = '-';
                }
                @endphp
            <tr>
                <td>{{$activity->id}}</td>
                <td>{{$activity->description}}</td>
                <td>{{$activity->event}}</td>
                <td>{{$item->name ?? $item->title ?? $activity->causer_type." (".$activity->causer_id.")" }}</td>
                <td>{{$activity->created_at}}</td>
                <td width="120">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#code{{$activity->id}}">
                        <i data-feather="eye"></i>
                    </button>
                    <div
                        class="modal fade text-start"
                        id="code{{$activity->id}}"
                        tabindex="-1"
                        aria-labelledby="label{{$activity->id}}"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="label{{$activity->id}}">@lang("activity_log.Changes")</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @switch($activity->event)
                                        @case('created')
                                            <h6 class="mb-2">@lang("activity_log.New Record")</h6>
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>@lang("activity_log.Column")</th>
                                                <th>@lang("activity_log.Value")</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($activity->properties['attributes'] as $row=>$attributes)
                                                <tr>
                                                    <td class="pe-1">{{$row}}</td>
                                                    <td><strong>{{$attributes}}</strong></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @break
                                        @case('updated')
                                        <h6 class="mb-2">@lang("activity_log.Record Updated")</h6>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>@lang("activity_log.Column")</th>
                                                    <th>@lang("activity_log.Old Value")</th>
                                                    <th>@lang("activity_log.New Value")</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($activity->properties['attributes'] as $row=>$attributes)
                                                <tr>
                                                    <td class="pe-1">{{$row}}</td>
                                                    <td><strong>{{$activity->properties['old'][$row]}}</strong></td>
                                                    <td><strong>{{$attributes}}</strong></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @break
                                        @case('deleted')
                                        <h6 class="mb-2">@lang("activity_log.Record Deleted")</h6>
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>@lang("activity_log.Column")</th>
                                                <th>@lang("activity_log.Old Value")</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($activity->properties['old'] as $row=>$attributes)
                                                <tr>
                                                    <td class="pe-1">{{$row}}</td>
                                                    <td><strong>{{$attributes}}</strong></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @break
                                        @default
                                        <textarea class="code" style="direction: ltr">{{json_encode($activity->properties,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)}}</textarea>
                                    @endswitch
                                    @php
                                    /*foreach ($activity->properties['attributes'] as $attributes){
                                    var_dump($attributes);
                                    }**/
                                    @endphp

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">@lang("activity_log.Close")</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@section("vendor-style")
    <link rel="stylesheet" href="{{asset("vendor/codemirror/lib/codemirror.css")}}">
    <link rel="stylesheet" href="{{asset("vendor/codemirror/theme/darcula.css")}}">
@endsection
@section("page-script")
    <script src="{{asset("vendor/codemirror/lib/codemirror.js")}}"></script>
    <script src="{{asset("vendor/codemirror/mode/javascript/javascript.js")}}"></script>
    <script src="{{asset("vendor/codemirror/addon/selection/active-line.js")}}"></script>
    <script src="{{asset("vendor/codemirror/addon/edit/matchbrackets.js")}}"></script>
    <script src="{{asset("vendor/codemirror/addon/display/autorefresh.js")}}"></script>
    <script>
        function qsa(sel) {
            return Array.apply(null, document.querySelectorAll(sel));
        }
        qsa(".code").forEach(function (editorEl) {
            CodeMirror.fromTextArea(editorEl, {
                lineNumbers: true,
                autoRefresh: true,
                matchBrackets: true,//application/json
                theme: 'darcula',
            });
        });
    </script>
@endsection
