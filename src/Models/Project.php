<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'team_id', 'user_id', 'budget', 'status', 'purpose', 'progress', 'description', 'urgency'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'project_id');
    }
    public function progressColor()
    {
        $progress = $this->progress;
    }
    public function isNotWebDevelopment()
    {
        $loopme =
            [
                'Mobile App Development',
                'Digital Marketing',
                'Data Analysis',
                'Desktop App Development',
            ];
            $isNotWeb=false;
        foreach ($loopme as $key => $value) {
            if($this->purpose==$value){
                $isNotWeb =true;  
            }
        }
        return $isNotWeb;
    }
}
