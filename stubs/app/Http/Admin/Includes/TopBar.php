<?php

namespace App\Http\Admin\Includes;

use Livewire\Component;
use App\Models\Notification;

class TopBar extends Component
{
    protected $listeners = [
        'refresh-top-bar' => '$refresh',
    ];

    public function render()
    {
        if(auth()->check()){
        $TeamNotifications=Notification::orderBy('id','desc')->where('team_id',auth()->user()->CurrentTeam->id)->where('seen','false')->get();
        $PersonalNotification=Notification::orderBy('id','desc')->where('user_id',auth()->user()->CurrentTeam->id)->where('seen','false')->get();
        $notifications=$TeamNotifications->concat($PersonalNotification)->unique();
        // $notifications=Notification::all();
        }else{
            $notifications=[];
        }
        
        
        return view('admin.includes.top-bar',[
            'notifications'=>$notifications
        ]);
    }

    public function viewNotification($id)
    {
$notification=Notification::find($id);
$notification->seen='true';
$notification->save();
return redirect()->to(url($notification->link));
    }
}
