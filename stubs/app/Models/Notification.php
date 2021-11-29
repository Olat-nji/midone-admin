<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'message', 'type', 'user_id', 'team_id','from','link','seen'];

    public static function new(array $notification)
    {
        Notification::create([
            'name' => $notification['name'],
            'message' => $notification['message'],
            'type' => $notification['type'],
            'user_id' => $notification['user_id'],
            'team_id' => $notification['team_id'],
            'from' => $notification['from'],
            'link' => $notification['link'],
            'seen' => $notification['seen'],
        ]);
        foreach ($notification['to'] as $recipient) {
            // Mail::to($recipient->email)->queue(new NewProject($notification['project'],$notification['user']));
        }
    }


    public function fromUser()
    {
        return $this->belongsTo('App\Models\User','from');
    }
    
}
