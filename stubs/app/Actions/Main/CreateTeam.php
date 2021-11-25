<?php

namespace App\Actions\Main;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesTeams;
use App\Helpers\MainHelper;

class CreateTeam implements CreatesTeams
{
    /**
     * Validate and create a new team for the given user.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return mixed
     */
    public function create($user, array $input)
    {
        Gate::forUser($user)->authorize('create', MainHelper::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createTeam');

        return $user->ownedTeams()->create([
            'name' => $input['name'],
            'personal_team' => false,
        ]);
    }
}
