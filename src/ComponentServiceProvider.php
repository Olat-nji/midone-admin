<?php

namespace Olatunji\MidoneAdmin;

use App\Helpers\Features;
use App\Http\Admin\Api\ApiTokenManager;

use App\Http\Admin\Profile\DeleteUserForm;
use App\Http\Admin\Profile\LogoutOtherBrowserSessionsForm;
use App\Http\Admin\Profile\TwoFactorAuthenticationForm;
use App\Http\Admin\Profile\UpdatePasswordForm;
use App\Http\Admin\Profile\UpdateProfileInformationForm;
use App\Http\Admin\Team\CreateTeamForm as TeamCreateTeamForm;
use App\Http\Admin\Team\DeleteTeamForm;
use App\Http\Admin\Team\TeamMemberManager;
use App\Http\Admin\Team\UpdateTeamNameForm;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Livewire::component('navigation-dropdown', NavigationDropdown::class);
        Livewire::component('profile.update-profile-information-form', UpdateProfileInformationForm::class);
        Livewire::component('profile.update-password-form', UpdatePasswordForm::class);
        Livewire::component('profile.two-factor-authentication-form', TwoFactorAuthenticationForm::class);
        Livewire::component('profile.logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
        Livewire::component('profile.delete-user-form', DeleteUserForm::class);

        if (Features::hasApiFeatures()) {
            Livewire::component('api.api-token-manager', ApiTokenManager::class);
        }

        if (Features::hasTeamFeatures()) {
            Livewire::component('admin.teams.create-team-form', TeamCreateTeamForm::class);
            Livewire::component('admin.teams.update-team-name-form', UpdateTeamNameForm::class);
            Livewire::component('admin.teams.team-member-manager', TeamMemberManager::class);
            Livewire::component('admin.teams.delete-team-form', DeleteTeamForm::class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        Blade::component('layouts.guest', 'guest-layout');
        Blade::component('admin.layouts.app', 'app-layout');
    }

    /**
     * Configure the Jetstream Blade components.
     *
     * @return void
     */

    
}
