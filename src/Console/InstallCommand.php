<?php

namespace Olatunji\MidoneAdmin\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'midone-admin:install {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the  Midone components and resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {



        $this->callSilent('vendor:publish', ['--tag' => 'config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'views', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'database', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'app', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'public', '--force' => true]);
        






        $this->callSilent('vendor:publish', ['--tag' => 'fortify-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-support', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-migrations', '--force' => true]);

        // "Home" Route...
        $this->replaceInFile('/home', '/dashboard', app_path('Providers/RouteServiceProvider.php'));



        // Fortify Provider...
        $this->installServiceProviderAfter('RouteServiceProvider', 'FortifyServiceProvider');

        // Configure Session...
        $this->configureSession();

        // AuthenticateSession Middleware...
        $this->replaceInFile(
            '// \Illuminate\Session\Middleware\AuthenticateSession::class',
            '\Olatunji\MidoneAdmin\Http\Middleware\AuthenticateSession::class',
            app_path('Http/Kernel.php')
        );
        //


        // Install Stack...

        $this->installLivewireStack();
    }

    /**
     * Configure the session driver for Midone Admin.
     *
     * @return void
     */
    protected function configureSession()
    {
        if (!class_exists('CreateSessionsTable')) {
            try {
                $this->call('session:table');
            } catch (Exception $e) {
                //
            }
        }

        $this->replaceInFile("'SESSION_DRIVER', 'file'", "'SESSION_DRIVER', 'database'", config_path('session.php'));
        $this->replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env'));
        $this->replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env.example'));
    }

    /**
     * Install the Livewire stack into the application.
     *
     * @return void
     */
    protected function installLivewireStack()
    {
        

        // Sanctum...
        (new Process(['php', 'artisan', 'vendor:publish', '--provider=Laravel\Sanctum\SanctumServiceProvider', '--force'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });



        // Directories...
        



        // Service Providers...
        copy(__DIR__ . '/../../stubs/app/Providers/MainServiceProvider.php', app_path('Providers/MainServiceProvider.php'));
        copy(__DIR__ . '/../../stubs/app/Providers/ComponentServiceProvider.php', app_path('Providers/ComponentServiceProvider.php'));

        $this->replaceInFile(
            'Olatunji\MidoneAdmin',
            "App",
            app_path('Providers/ComponentServiceProvider.php')
        );

        $this->installServiceProviderAfter('FortifyServiceProvider', 'MainServiceProvider');
        $this->installServiceProviderAfter('MainServiceProvider', 'ComponentServiceProvider');



                // Routes...
                $this->replaceInFile('auth:api', 'auth:sanctum', base_path('routes/api.php'));



                $routes = file_get_contents(base_path('routes/web.php'));
                file_put_contents(base_path('routes/web.php'), str_replace(
                    'use Illuminate\Support\Facades\Route;',
                    'use Illuminate\Support\Facades\Route;' . PHP_EOL . 'use App\Http\Controllers\CurrentTeamController;'
                        . PHP_EOL . 'use App\Http\Controllers\Livewire\ApiTokenController;'
                        . PHP_EOL . 'use App\Http\Controllers\Livewire\TeamController;'
                        . PHP_EOL . 'use App\Http\Controllers\Livewire\UserProfileController;'
                        . PHP_EOL . 'use App\Helpers\MainHelper;'
                        . PHP_EOL . 'use Laravel\Fortify\Fortify;',
                    $routes
                ));
                $routes = file_get_contents(base_path('routes/web.php'));
                $routeDefinition = <<<'EOF'
        
        
                Route::post('git-pull-it', function () {
                    return shell_exec('git pull origin new-frontend-main');
                });
                Fortify::loginView(function () {
                    return view('auth.login');
                });
                
                Fortify::registerView(function () {
                    return view('auth.register');
                });
                Fortify::requestPasswordResetLinkView(function () {
                    return view('auth.forgot-password');
                });
                Fortify::resetPasswordView(function ($request) {
                    return view('auth.reset-password', ['request' => $request]);
                });
                
                
                // Fortify::verifyEmailView(function () {
                //     return view('auth.verify-email');
                // });
              
                
                
                
                Route::get('/', function () {
                    return view('auth.login');
                })->name('index');
                
                Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
                
                    Route::get('/dashboard', App\Http\Admin\Dashboard::class)->name('dashboard');
                
                    Route::get('/users', App\Http\Admin\Users::class)->name('users');
                
                
                
                    // User & Profile...
                    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
                
                
                    // API...
                    if (MainHelper::hasApiFeatures()) {
                        Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
                    }
                
                    // Teams...
                    if (MainHelper::hasTeamFeatures()) {
                        Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                        Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                        Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
                    }
                });
                
        EOF;
        
                (new Filesystem)->append(base_path('routes/web.php'), $routeDefinition);
        


        // Routes...
        $this->replaceInFile('auth:api', 'auth:sanctum', base_path('routes/api.php'));

        


        $this->line('');
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Fortify'));
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Main'));
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->ensureDirectoryExists(public_path('css'));
        (new Filesystem)->ensureDirectoryExists(resource_path('css'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/admin'));


        (new Filesystem)->deleteDirectory(resource_path('sass'));

        
        $this->info('Midone Admin scaffolding installed successfully.');
        // $this->comment('Please execute "npm install && npm run dev" to build your assets.');
    }







    /**
     * Install the service provider in the application configuration file.
     *
     * @param  string  $after
     * @param  string  $name
     * @return void
     */
    protected function installServiceProviderAfter($after, $name)
    {
        if (!Str::contains($appConfig = file_get_contents(config_path('app.php')), 'App\\Providers\\' . $name . '::class')) {
            file_put_contents(config_path('app.php'), str_replace(
                'App\\Providers\\' . $after . '::class,',
                'App\\Providers\\' . $after . '::class,' . PHP_EOL . '        App\\Providers\\' . $name . '::class,',
                $appConfig
            ));
        }
    }

    /**
     * Install the middleware to a group in the application Http Kernel.
     *
     * @param  string  $after
     * @param  string  $name
     * @param  string  $group
     * @return void
     */
    protected function installMiddlewareAfter($after, $name, $group = 'web')
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $middlewareGroups = Str::before(Str::after($httpKernel, '$middlewareGroups = ['), '];');
        $middlewareGroup = Str::before(Str::after($middlewareGroups, "'$group' => ["), '],');

        if (!Str::contains($middlewareGroup, $name)) {
            $modifiedMiddlewareGroup = str_replace(
                $after . ',',
                $after . ',' . PHP_EOL . '            ' . $name . ',',
                $middlewareGroup,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $middlewareGroups,
                str_replace($middlewareGroup, $modifiedMiddlewareGroup, $middlewareGroups),
                $httpKernel
            ));
        }
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }



    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
