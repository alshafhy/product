<div class="table-responsive">
    <table class="table table-bordered" id="notifications-table">
        <thead>
        <tr>
            <th>@lang('models/notifications.fields.title')</th>
            <th>@lang('models/notifications.fields.message')</th>
            <th>@lang('models/notifications.fields.read_at')</th>
            <th>@lang('models/notifications.fields.created_at')</th>
            <th class="text-center" >@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->data['title'] }}</td>
                <td>{{ $notification->data['message'] }}</td>
                <td>
                    @if(is_null($notification->read_at))
                        <i data-feather="mail"></i>
                    @else
                        {{ $notification->read_at }}
                    @endif
                </td>
                <td>{{ $notification->created_at->toDateTimeString() }}</td>
                <td>
                    @if(isset($notification->data['link']) && $notification->data['message'])
                        <a href="{{$notification->data['link']}}"
                           data-bs-toggle="tooltip"
                           title="@lang("models/notifications.Link")"
                           class='btn btn-outline-primary btn-sm'>
                            <i data-feather="link"></i>
                        </a>
                    @endif
                    @if(is_null($notification->read_at))
                        <a href="{{ route('markAsReadNotification',$notification->id) }}"
                           data-bs-toggle="tooltip"
                           class='btn btn-outline-primary btn-sm' title="@lang("models/notifications.Mark As Read")">
                            <i data-feather="check"></i>
                        </a>
                    @endif
                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>
