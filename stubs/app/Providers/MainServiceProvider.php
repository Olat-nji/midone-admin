<?php

namespace App\Providers;

use App\Actions\Main\AddTeamMember;
use App\Actions\Main\CreateTeam;
use App\Actions\Main\DeleteTeam;
use App\Actions\Main\DeleteUser;
use App\Actions\Main\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use App\Helpers\MainHelper;
class MainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        MainHelper::createTeamsUsing(CreateTeam::class);
        MainHelper::updateTeamNamesUsing(UpdateTeamName::class);
        MainHelper::addTeamMembersUsing(AddTeamMember::class);
        MainHelper::deleteTeamsUsing(DeleteTeam::class);
        MainHelper::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        MainHelper::defaultApiTokenPermissions(['read']);

        MainHelper::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        MainHelper::role('editor', 'Editor', [
            'read',
            'create',
            'update',
        ])->description('Editor users have the ability to read, create, and update.');
    }
}
