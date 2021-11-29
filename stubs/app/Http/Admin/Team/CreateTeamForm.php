<?php

namespace App\Http\Admin\Team;

use Illuminate\Support\Facades\Auth;
use App\Contracts\CreatesTeams;
use Livewire\Component;

class CreateTeamForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * Create a new team.
     *
     * @param  \App\Contracts\CreatesTeams
     * @return void
     */
    public function createTeam(CreatesTeams $creator)
    {
        $this->resetErrorBag();

        $creator->create(Auth::user(), $this->state);

        return redirect(config('fortify.home'));
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('admin.teams.create-team-form');
    }
}
