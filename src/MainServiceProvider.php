<?php

namespace Olatunji\MidoneAdmin;


use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

use Laravel\Fortify\Fortify;


use Livewire\Livewire;

class MainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'jetstream');

        Fortify::viewPrefix('auth.');

        $this->configureComponents();
        $this->configurePublishing();
        $this->configureCommands();

        RedirectResponse::macro('banner', function ($message) {
            return $this->with('flash', [
                'bannerStyle' => 'success',
                'banner' => $message,
            ]);
        });

        RedirectResponse::macro('dangerBanner', function ($message) {
            return $this->with('flash', [
                'bannerStyle' => 'danger',
                'banner' => $message,
            ]);
        });

        
    }

    /**
     * Configure the Jetstream Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('action-message');
            $this->registerComponent('action-section');
            $this->registerComponent('application-logo');
            $this->registerComponent('application-mark');
            $this->registerComponent('authentication-card');
            $this->registerComponent('authentication-card-logo');
            $this->registerComponent('banner');
            $this->registerComponent('button');
            $this->registerComponent('confirmation-modal');
            $this->registerComponent('confirms-password');
            $this->registerComponent('danger-button');
            $this->registerComponent('dialog-modal');
            $this->registerComponent('dropdown');
            $this->registerComponent('dropdown-link');
            $this->registerComponent('form-section');
            $this->registerComponent('input');
            $this->registerComponent('checkbox');
            $this->registerComponent('input-error');
            $this->registerComponent('label');
            $this->registerComponent('modal');
            $this->registerComponent('nav-link');
            $this->registerComponent('responsive-nav-link');
            $this->registerComponent('responsive-switchable-team');
            $this->registerComponent('secondary-button');
            $this->registerComponent('section-border');
            $this->registerComponent('section-title');
            $this->registerComponent('switchable-team');
            $this->registerComponent('validation-errors');
            $this->registerComponent('welcome');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('jetstream::components.'.$component, 'jet-'.$component);
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/main.php' => config_path('main.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../database' => database_path('/'),
        ], 'database');

        $this->publishes([
            __DIR__.'/../stubs/Http/Models' => app_path('/Http/Models'),
        ], 'models');

        

        

        $this->publishes([
            __DIR__.'/../stubs/app' => app_path('/'),
        ], 'app');

        $this->publishes([
            __DIR__.'/../stubs/public' => public_path('/'),
        ], 'public');


        $this->publishes([
            __DIR__.'/../routes/' => base_path('routes/web.php'),
        ], 'routes');

    }


    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }

}