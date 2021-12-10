<?php

namespace App\Http\Admin;

use App\Models\Contact;

use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{

    use WithPagination;


    public $usersCount;
    public $adminUsersCount;

    public function mount()
    {
        $this->adminUsersCount = count(Team::where('id', 2)->get()->first()->allUsers());
        $this->adminUsersCount += count(Team::where('id', 1)->get()->first()->allUsers());
        $this->usersCount = (User::all()->count()) - $this->adminUsersCount;
    }



    public function render()
    {
        $users_today = DB::table('sessions')->whereDate('last_activity', '>=', Carbon::today()->getTimestamp())->get();

        $users_today = count($users_today);


        return view(
            'admin.dashboard',
            [
                'users_today' => $users_today,
                'messages' => Contact::where('status', null)->get(),
                'users' => User::orderBy('id', 'desc')->get()->take(6)
            ]
        )->layout('admin.layouts.app');
    }
}
