<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment','user_id','project_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

}
