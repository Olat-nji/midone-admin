<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\MainHelper;

class CurrentTeamController extends Controller
{
    /**
     * Update the authenticated user's current team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $team = MainHelper::newTeamModel()->findOrFail($request->team_id);

        if (! $request->user()->belongsToTeam($team)) {
            abort(403);
        }

        $request->user()->forceFill([
            'current_team_id' => $team->id,
        ])->save();

        return redirect(config('fortify.home'), 303);
    }
}
