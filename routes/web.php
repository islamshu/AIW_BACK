<?php

use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeServiceController;
use App\Http\Controllers\HomeStatController;
use App\Http\Controllers\SectorController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

use Laravel\Fortify\Features;

Route::get('/', function () {
    // return Inertia::render('Home');
    return view('welcom');
})->name('home');
Route::get('/__test-locale', function () {
    return [
        'session_locale' => session('locale'),
        'app_locale' => app()->getLocale(),
    ];
});

Route::get('/lang/{lang}', function ($lang) {
    session(['locale' => $lang]);
    app()->setLocale($lang);
    
    return back();
})->name('language.switch');


Route::get('/about', fn() => Inertia::render('About'));
Route::get('/vision', fn() => Inertia::render('Vision'));
Route::get('/strategy', fn() => Inertia::render('Strategy'));
Route::get('/sectors', fn() => Inertia::render('Sectors'));
Route::get('/contact', fn() => Inertia::render('Contact'));
Route::get('/login', [DashbaordController::class, 'login'])->name('login');
Route::post('/login', [DashbaordController::class, 'post_login'])->name('post_login');
Route::middleware(['admin'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashbaordController::class, 'dashboard'])->name('dashboard');
    Route::get('/edit_profile', [DashbaordController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/edit_profile', [DashbaordController::class, 'edit_profile_post'])->name('edit_profile_post');
    Route::post('/add_general', [DashbaordController::class, 'add_general'])->name('add_general');
    Route::get('/logout', [DashbaordController::class, 'logout'])->name('logout');
    Route::get('/setting', [DashbaordController::class, 'setting'])->name('setting');
    Route::resource('sectors', SectorController::class)
        ->except(['show']);
    Route::post(
        'sectors/{homeService}/toggle',
        [SectorController::class, 'toggleStatus']
    )->name('sectors.toggle');
    Route::get('home-stats', [HomeStatController::class, 'edit'])
    ->name('home-stats.edit');

Route::post('home-stats', [HomeStatController::class, 'update'])
    ->name('home-stats.update');

    Route::post('sectors/sort', [SectorController::class, 'sort'])
        ->name('sectors.sort');
    Route::get('home-hero', [HeroController::class, 'edit'])
        ->name('home-hero.edit');
    Route::put('home-hero', [HeroController::class, 'update'])
        ->name('home-hero.update');
    Route::resource('home-services', HomeServiceController::class)
        ->except(['show']);
    Route::get('icons', function () {
        return view('dashboard.icons.index');
    })->name('icons.index');

    Route::post('home_services/sort', [HomeServiceController::class, 'sort'])
        ->name('home-services.sort');
    Route::post(
        'home-services/{homeService}/toggle',
        [HomeServiceController::class, 'toggleStatus']
    )->name('home-services.toggle');
});

require __DIR__ . '/settings.php';
