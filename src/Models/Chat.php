<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable =['seen'];

    public function recipients(){
        return  $this->hasManyThrough('App\Models\Chat_Recipient','App\Models\User','chat_id','user_id');
    }

    public function messages(){
        return  $this->hasMany('App\Models\Message','chat_id');
    }

}
