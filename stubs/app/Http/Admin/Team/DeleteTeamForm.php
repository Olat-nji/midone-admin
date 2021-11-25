<?php

namespace App\Http\Admin\Team;

use Illuminate\Support\Facades\Auth;
use App\Actions\ValidateTeamDeletion;
use App\Contracts\DeletesTeams;
use Livewire\Component;

class DeleteTeamForm extends Component
{
    /**
     * The team instance.
     *
     * @var mixed
     */
    public $team;

    /**
     * Indicates if team deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingTeamDeletion = false;

    /**
     * Mount the component.
     *
     * @param  mixed  $team
     * @return void
     */
    public function mount($team)
    {
        $this->team = $team;
    }

    /**
     * Delete the team.
     *
     * @param  \App\Actionss\ValidateTeamDeletion  $validator
     * @param  \App\Contracts\DeletesTeams  $deleter
     * @return void
     */
    public function deleteTeam(ValidateTeamDeletion $validator, DeletesTeams $deleter)
    {
        $validator->validate(Auth::user(), $this->team);

        $deleter->delete($this->team);

        return redirect(config('fortify.home'));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('admin.teams.delete-team-form');
    }
}
