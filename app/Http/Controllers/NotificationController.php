<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends AppBaseController
{


    public function markAsReadNotificationAll(){
        auth()->user()->unreadNotifications->markAsRead();
        return $this->sendSuccess('تم تعليم كمقروء');
    }

    public function markAsReadNotification($id){
        $notifications = auth()->user()->unreadNotifications;
        //dd($notifications->where('id',$id));
        $notifications->where('id',$id)->markAsRead();
        return $this->sendSuccess('تم تعليم كمقروء');
    }

    public function showNotification(){
        $notifications = auth()->user()->notifications()->paginate();
        return view('notification.index',['notifications'=>$notifications]);
    }
}
