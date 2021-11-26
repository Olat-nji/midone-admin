<?php

namespace App\Http\Admin\Includes;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{

    
    
    
    

    public function render()
    {
        if(is_admin()){
        $projects = Project::all();

        }else{
            $projects = Project::where('team_id', auth()->user()->CurrentTeam->id)->get();

        }
        return view(
            'admin.includes.search',
            [
                'searchusers'=>User::all(),
                'searchprojects'=>$projects
            ]
        );
    }
}
