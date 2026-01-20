<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeSectionController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeServiceController;
use App\Http\Controllers\HomeStatController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobsFrontController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PagePreviewController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Preview Page
Route::get('/preview/{page}', [PagePreviewController::class, 'show'])
    ->name('pages.preview');

// Home
Route::get('/', function () {
    return view('frontend.index');
})->name('home');
// routes/web.php
Route::get('/sectors', [HomeController::class, 'index'])->name('web.sectors.index');
Route::get('/sectors/load-more', [HomeController::class, 'loadMore'])->name('sectors.loadMore');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'store'])
    ->name('contact.send');


// Language Switch
Route::get('/lang/{lang}', function ($lang) {
    if (! in_array($lang, ['ar', 'en'])) {
        abort(400);
    }

    session()->put('locale', $lang);

    return redirect(url()->previous() ?? '/');
})->name('language.switch');

/*
|--------------------------------------------------------------------------
| Frontend Pages (Inertia)
|--------------------------------------------------------------------------
\
/*
|--------------------------------------------------------------------------
| Jobs Frontend
|--------------------------------------------------------------------------
*/
Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', [JobsFrontController::class, 'index'])->name('index');
    Route::get('/{job}/json', [JobsFrontController::class, 'showJson'])->name('json');
    Route::post('/apply', [JobsFrontController::class, 'apply'])->name('apply');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/login', [DashbaordController::class, 'login'])->name('login');
Route::post('/login', [DashbaordController::class, 'post_login'])->name('post_login');

/*
|--------------------------------------------------------------------------
| Dashboard (Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->prefix('dashboard')->group(function () {

    /*
    |----------------------------------------------------------------------
    | Dashboard Core
    |----------------------------------------------------------------------
    */
    Route::get('/', [DashbaordController::class, 'dashboard'])->name('dashboard');
    Route::get('/edit_profile', [DashbaordController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/edit_profile', [DashbaordController::class, 'edit_profile_post'])->name('edit_profile_post');
    Route::post('/add_general', [DashbaordController::class, 'add_general'])->name('add_general');
    Route::get('/logout', [DashbaordController::class, 'logout'])->name('logout');
    Route::get('/setting', [DashbaordController::class, 'setting'])->name('setting');

    /*
    |----------------------------------------------------------------------
    | About Page Management
    |----------------------------------------------------------------------
    */
    Route::prefix('about')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('about.index');
        Route::post('/step', [AboutController::class, 'storeStep'])->name('about.step.store');
        Route::post('/step/{step}/toggle', [AboutController::class, 'toggleStep']);
        Route::post('/steps/sort', [AboutController::class, 'sortSteps'])->name('about.steps.sort');
    });

    /*
    |----------------------------------------------------------------------
    | Home Page Settings
    |----------------------------------------------------------------------
    */
    Route::get('home-hero', [HeroController::class, 'edit'])->name('home-hero.edit');
    Route::put('home-hero', [HeroController::class, 'update'])->name('home-hero.update');

    Route::get('home-stats', [HomeStatController::class, 'edit'])->name('home-stats.edit');
    Route::post('home-stats', [HomeStatController::class, 'update'])->name('home-stats.update');

    Route::resource('home-services', HomeServiceController::class)->except('show');
    Route::post('home_services/sort', [HomeServiceController::class, 'sort'])->name('home-services.sort');
    Route::post('home-services/{homeService}/toggle', [HomeServiceController::class, 'toggleStatus'])->name('home-services.toggle');


    Route::get('/contacts', [ContactController::class, 'index'])->name('dashboard.contacts.index');
    Route::get('/contacts/{contactMessage}', [ContactController::class, 'show'])->name('dashboard.contacts.show');
    Route::delete(
        '/contacts/{contactMessage}',
        [ContactController::class, 'destroy']
    )->name('dashboard.contacts.destroy');

    /*
    |----------------------------------------------------------------------
    | Sectors
    |----------------------------------------------------------------------
    */
    Route::resource('sectors', SectorController::class)->except('show');
    Route::post('sectors/sort', [SectorController::class, 'sort'])->name('sectors.sort');
    Route::post('sectors/{homeService}/toggle', [SectorController::class, 'toggleStatus'])->name('sectors.toggle');

    /*
    |----------------------------------------------------------------------
    | Icons
    |----------------------------------------------------------------------
    */
    Route::get('icons', fn() => view('dashboard.icons.index'))->name('icons.index');


    Route::post('/sectors_page/toggle', [SectorController::class, 'toggle'])
        ->name('dashboard.sectors_page.toggle');

    Route::prefix('home-sections')->group(function () {

        Route::get('/', [HomeSectionController::class, 'index'])
            ->name('dashboard.home-sections.index');
            Route::delete('/sections/destroy/{id}', [HomeSectionController::class, 'destroy'])
            ->name('dashboard.sections.destroy');
            
        Route::post('/', [HomeSectionController::class, 'store'])
            ->name('dashboard.home-sections.store');

        Route::post('/{section}/toggle', [HomeSectionController::class, 'toggle']);

        Route::post('/reorder', [HomeSectionController::class, 'reorder'])
            ->name('dashboard.home-sections.reorder');

        Route::get('/{section}/edit', [HomeSectionController::class, 'edit'])
            ->name('dashboard.home-sections.edit');
        Route::put(
            '/home-sections/{section}',
            [HomeSectionController::class, 'update']
        )->name('dashboard.home-sections.update');
        Route::get(
            '/{section}/content',
            [HomeSectionController::class, 'getContent']
        );

        Route::post(
            '/{section}/content',
            [HomeSectionController::class, 'saveContent']
        );
    });

    /*
    |----------------------------------------------------------------------
    | Users / Roles / Permissions
    |----------------------------------------------------------------------
    */
    Route::name('dashboard.')->group(function () {

        Route::resource('users', UserController::class)->except('show');
        Route::resource('roles', RoleController::class)->except('show');
        Route::resource('permissions', PermissionController::class)->except('show');

        /*
        |------------------------------------------------------------------
        | Pages
        |------------------------------------------------------------------
        */
        Route::get('pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('pages/{page}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

        Route::post('pages/bulk', [PageController::class, 'bulk'])->name('pages.bulk');
        Route::post('pages/{id}/restore', [PageController::class, 'restore'])->name('pages.restore');
        Route::delete('pages/{id}/force', [PageController::class, 'forceDelete'])->name('pages.forceDelete');

        Route::post('pages/{page}/layouts', [PageController::class, 'store_layout'])->name('layouts.store');
        Route::delete('pages/{page}/layouts/{layoutId}', [PageController::class, 'destroyLayout'])->name('layouts.destroy');

        Route::post('pages/{page}/sections', [PageController::class, 'addSection'])->name('pages.sections.add');
        Route::put('sections/{section}', [PageController::class, 'updateSection'])->name('pages.sections.update');
        Route::delete('pages/sections/{section}', [PageController::class, 'deleteSection'])->name('pages.sections.delete');

        Route::post('pages/sections/{section}/move-up', [PageController::class, 'moveSectionUp'])->name('pages.sections.moveUp');
        Route::post('pages/sections/{section}/move-down', [PageController::class, 'moveSectionDown'])->name('pages.sections.moveDown');
        Route::put('pages/{page}/sections/batch', [PageController::class, 'batchUpdateSections'])->name('pages.sections.batchUpdate');

        Route::get('pages/{page}/preview', [PageController::class, 'preview'])->name('pages.preview');
        Route::get('pages/{page}/toggle', [PageController::class, 'toggleStatus'])
            ->name('pages.toggle');
        Route::post('/pages/reorder', [PageController::class, 'reorder'])
            ->name('pages.reorder');

        Route::get('/sections/repeater-item', function () {
            return view('dashboard.pages.sections.types.repeater-item-template');
        })->name('sections.repeater-item');

        /*
        |------------------------------------------------------------------
        | Jobs
        |------------------------------------------------------------------
        */
        Route::resource('jobs', JobController::class)->names('jobs');
        Route::get('jobs/{job}/toggle', [JobController::class, 'toggle'])->name('jobs.toggle');
        Route::get('jobs/{job}/applications', [JobController::class, 'index_applications'])
            ->name('jobs.applications.index');
    });

    /*
    |----------------------------------------------------------------------
    | Media Library
    |----------------------------------------------------------------------
    */
    Route::prefix('media')->name('dashboard.media.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::get('/grid', [MediaController::class, 'grid'])->name('grid');
        Route::post('/upload', [MediaController::class, 'upload'])->name('upload');
        Route::patch('/{media}', [MediaController::class, 'update'])->name('update');
        Route::delete('/{media}', [MediaController::class, 'destroy'])->name('destroy');
    });

    /*
    |----------------------------------------------------------------------
    | Dashboard Page Preview
    |----------------------------------------------------------------------
    */
    Route::get('pages/{page}/preview', [PagePreviewController::class, 'showdash'])
        ->name('dashboard.pages.preview');
});
Route::get('/{slug}', [PagePreviewController::class, 'show'])->name('page.show');

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/settings.php';
