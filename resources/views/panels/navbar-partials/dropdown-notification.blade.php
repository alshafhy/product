<li class="nav-item dropdown dropdown-notification me-25">
    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
      <i class="ficon" data-feather="bell"></i>
      {{-- {{dd(auth()->user())}} --}}
     
      @if(Auth::check() && auth()->user()->unreadNotifications->count())
        <span id="unreadNotifications" class="unreadNotificationsCount badge rounded-pill bg-danger badge-up">{{auth()->user()->unreadNotifications->count()}}</span>
      @endif


      
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
      <li class="dropdown-menu-header">
        <div class="dropdown-header d-flex">
          <h4 class="notification-title mb-0 me-auto"><a href="{{route("showNotification")}}"> التنبيهات</a></h4>
          @if(Auth::check() && auth()->user()->unreadNotifications->count())
            <div class="badge rounded-pill badge-light-primary"> <span class="unreadNotificationsCount">{{auth()->user()->unreadNotifications->count()}}</span>  تنبيهات جديدة </div>
          @endif
        </div>
      </li>
      <li class="scrollable-container media-list">
        @if(Auth::check() && auth()->user()->unreadNotifications->count())
          @foreach (auth()->user()->unreadNotifications as $notification)
              <span class="notification-section">
              <a class="d-flex" @if(isset($notification->data['link']) && $notification->data['link']) href="{{$notification->data['link']}}" target="_blank" @endif>
              <div class="list-item d-flex align-items-start">
                <div class="me-1">
                  <div class="avatar {{$notification->data['class_bg']}}"><!--bg-light-success-->
                    <div class="avatar-content"><i class="avatar-icon" data-feather="{{$notification->data['class_icon']}}"></i></div><!--check-->
                  </div>
                </div>
                <div class="list-item-body flex-grow-1">
                  <p class="media-heading"><span class="fw-bolder">{{$notification->data['title']}}</span></p><small
                    class="notification-text">{{$notification->data['message']}}</small>
                </div>
                <div class="ms-1" title="التعليم كمقروء">
                  <div class="avatar bg-info"><!--bg-light-success-->
                    <div class="avatar-content">
                      <a  href="javascript:void(0)" class="closeNotification" data-id="{{$notification->id}}"><span data-feather="x"></span></a>
                    </div><!--check-->
                  </div>
                </div>
              </div>
            </a>
              </span>
          @endforeach
        @endif

      </li>
      @if(Auth::check() && auth()->user()->unreadNotifications->count())
      <li class="dropdown-menu-footer">
        <a class="btn btn-primary w-100" id="markAsReadNotification">قراءه كل التنبيهات</a>
      </li>
      @else
      <li class="dropdown-menu-footer text-center">
          لا توجد تنبيهات
      </li>
      @endif
    </ul>
</li>
@section("page-script")
<script>

    let markAsReadNotification_url = '{{ route('markAsReadNotification','id') }}';
    $('.closeNotification').on('click',function(){
        let url = markAsReadNotification_url.replace('id',$(this).data('id'));
        let item = $(this).parent().parent().parent().parent().parent();
        $.get({
            url:url,
            success:function () {
                item.hide();
                let count = parseInt($("#unreadNotifications").text());
                count -=1;
                if(count<0){
                    count = 0;
                }
                $(".unreadNotificationsCount").text(count);
                //console.dir(count);
            }
        });
    });
    $('#markAsReadNotification').on('click',function(){
        $.get({
            url:'{{ route('markAsReadNotificationAll') }}',
            success:function () {
                $("#unreadNotifications").hide();
                $(".notification-section").hide();
                $(".unreadNotificationsCount").text(0);
            }
        });
    });
</script>
@append
