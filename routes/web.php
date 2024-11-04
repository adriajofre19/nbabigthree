<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\ClasificationController;
use App\Http\Controllers\CrudPlayersController;
use App\Http\Controllers\CrudUsersController;
use App\Http\Controllers\NotificationsController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\User;

use Laravel\Socialite\Facades\Socialite;
 
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();

    $userExists = User::where('external_id', $user->id)->first();

    if($userExists) {
        Auth::login($userExists);
    } else {
        $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'external_id' => $user->id,
            'avatar' => $user->avatar,
        ]);

        Auth::login($newUser);
    }

    return redirect('/my-team');
 
});

/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/my-team', [PlayersController::class, 'index'])->name('my-team');
    Route::post('/my-team/update', [PlayersController::class, 'update'])->name('players-titular-suplente.update');
    Route::post('/update-team-name', [PlayersController::class, 'updateTeamName'])->name('team-name.update');

    Route::get('/player/{id}', [PlayersController::class, 'getPlayerById'])->name('player');
    
    Route::get('/clasification', [ClasificationController::class, 'index'])->name('clasification');
    Route::get('/clasification-for-week', [ClasificationController::class, 'indexForWeek'])->name('clasification-for-week');

    Route::get('/get-team/{id}', [PlayersController::class, 'getTeamFromThePlayer'])->name('get-team');

    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
    Route::post('/create-notification-to-trade', [NotificationsController::class, 'create'])->name('create-notification-to-trade.create');
    Route::post('/notifications/handle-exchange', [NotificationsController::class, 'handleExchange'])->name('notifications.handle-exchange');

    Route::get('/crud-players', [CrudPlayersController::class, 'index'])->name('crud-players');
    Route::post('/crud-players/create', [CrudPlayersController::class, 'create'])->name('crud-players.create');
    Route::post('/crud-players/update', [CrudPlayersController::class, 'update'])->name('crud-players.update');
    Route::delete('/crud-players/delete', [CrudPlayersController::class, 'delete'])->name('crud-players.delete');
    Route::post('/crud-players/createFromCsvFile', [CrudPlayersController::class, 'createFromCsvFile'])->name('crud-players.createFromCsvFile');

    Route::get('/crud-users', [CrudUsersController::class, 'index'])->name('crud-users');
    Route::delete('/crud-users/delete', [CrudUsersController::class, 'delete'])->name('crud-users.delete');
});

require __DIR__.'/auth.php';
