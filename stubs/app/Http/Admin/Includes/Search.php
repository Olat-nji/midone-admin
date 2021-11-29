<?php

namespace App\Http\Admin\Includes;


use App\Models\User;
use Livewire\Component;

class Search extends Component
{

    
    
    
    

    public function render()
    {
        
        return view(
            'admin.includes.search',
            [
                'searchusers'=>User::all(),
                
            ]
        );
    }
}
