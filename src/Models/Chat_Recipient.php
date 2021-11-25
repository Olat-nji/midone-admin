<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_Recipient extends Model
{
    use HasFactory;
    protected $fillable =['user_id','chat_id','chatting','group_id'];

    public function chat(){
        return  $this->belongsTo('App\Models\Chat','chat_id');
    }
    public function user(){
        return  $this->belongsTo('App\Models\User','user_id');
    }
    public function toUser(){
        return  $this->belongsTo('App\Models\User','chatting');
    }
}
