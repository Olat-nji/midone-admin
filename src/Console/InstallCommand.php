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
    protected $signature = 'midone-admin:install {stack : The development stack that should be installed}
                                              {--teams : Indicates if team support should be installed}
                                              {--pest : Indicates if Pest should be installed}
                                              {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

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
        $this->callSilent('vendor:publish', ['--tag' => 'models', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'app', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'public', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'routes', '--force' => true]);




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

        // Install Stack...
        if ($this->argument('stack') === 'livewire') {
            $this->installLivewireStack();
        }

        // Tests...
        $stubs = $this->getTestStubsPath();
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
        // Install Livewire...
        $this->requireComposerPackages('livewire/livewire:^2.5');

        // Sanctum...
        (new Process(['php', 'artisan', 'vendor:publish', '--provider=Laravel\Sanctum\SanctumServiceProvider', '--force'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        // Update Configuration...

        // $this->replaceInFile("'guard' => 'web'", "'guard' => 'sanctum'", config_path('auth.php'));

        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return [
                '@tailwindcss/forms' => '^0.3.1',
                '@tailwindcss/typography' => '^0.4.0',
                'alpinejs' => '^3.0.6',
                'postcss-import' => '^14.0.1',
                'tailwindcss' => '^2.2.2',
            ] + $packages;
        });


        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Fortify'));
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Main'));
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->ensureDirectoryExists(public_path('css'));
        (new Filesystem)->ensureDirectoryExists(resource_path('css'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/admin'));


        (new Filesystem)->deleteDirectory(resource_path('sass'));


        // Service Providers...
        copy(__DIR__ . '/../../stubs/app/Providers/MainServiceProvider.php', app_path('Providers/MainServiceProvider.php'));
        $this->installServiceProviderAfter('FortifyServiceProvider', 'MainServiceProvider');



        // Actions...


        // View Components...
        copy(__DIR__ . '/../../routes/web.php', base_path('routes/web.php'));



        // Other Views...
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/livewire/resources/views/api', resource_path('views/api'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/livewire/resources/views/profile', resource_path('views/profile'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/livewire/resources/views/auth', resource_path('views/auth'));

        // Routes...
        $this->replaceInFile('auth:api', 'auth:sanctum', base_path('routes/api.php'));


        $this->line('');
        $this->info('MidoneAdmin scaffolding installed successfully.');
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
