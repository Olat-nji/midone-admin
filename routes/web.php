<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrentTeamController;
use App\Http\Controllers\Livewire\ApiTokenController;
use App\Http\Controllers\Livewire\TeamController;
use App\Http\Controllers\Livewire\UserProfileController;
use App\Helpers\MainHelper;
use Laravel\Fortify\Fortify;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


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

// Send Email
// Route::get('/test', function () {
//     $beautymail = app()->make(Snowfire\Beautymail\Beautymail::class);
//     $beautymail->send('emails.welcome', [], function ($message) {
//         $message
//             ->from('bar@example.com')
//             ->to('foo@example.com', 'John Smith')
//             ->subject('Welcome!');

//     });
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
