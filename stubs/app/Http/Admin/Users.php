<?php

namespace App\Http\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    

    public $q;
    protected $queryString = ['q'];
    public $pages=10;

    // public function updatingQ()
    // {
    //     $this->resetPage();
    // }
    

    public function render()
    {
        return view('admin.users',[

'users'=>\App\Models\User::orWhere('name', 'LIKE', '%'.$this->q.'%')->orWhere('email', 'LIKE', '%'.$this->q.'%')->orWhere('phone', 'LIKE', '%'.$this->q.'%')->paginate($this->pages),

        ])->layout('admin.layouts.app');
    }
}
