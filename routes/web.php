<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get(
        '/dashboard',
        [DashboardController::class, 'redirect']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    // Route::middleware([
    //     'auth',
    //     'role:Admin IT'
    // ])->group(function () {

    //     Route::get(
    //         '/admin/dashboard',
    //         [DashboardController::class, 'admin']
    //     )->name('admin.dashboard');

    // });
    Route::middleware(['auth', 'role:Admin IT'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get(
                '/dashboard',
                [DashboardController::class, 'admin']
            )->name('dashboard');

            Route::resource(
                'assets',
                AssetController::class
            );

        });

    /*
    |--------------------------------------------------------------------------
    | STAFF
    |--------------------------------------------------------------------------
    */
    // Route::middleware([
    //     'auth',
    //     'role:Staff'
    // ])->group(function () {

    //     Route::get(
    //         '/staff/dashboard',
    //         [DashboardController::class, 'staff']
    //     )->name('staff.dashboard');
    // });
    Route::middleware('role:Staff')
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {

            Route::get(
                '/dashboard',
                [DashboardController::class, 'staff']
            )->name('dashboard');

        });

    /*
    |--------------------------------------------------------------------------
    | MANAGER
    |--------------------------------------------------------------------------
    */
    // Route::middleware([
    //     'auth',
    //     'role:Manager'
    // ])->group(function () {

    //     Route::get(
    //         '/manager/dashboard',
    //         [DashboardController::class, 'manager']
    //     )->name('manager.dashboard');
    // });
    Route::middleware('role:Manager')
        ->prefix('manager')
        ->name('manager.')
        ->group(function () {

            Route::get(
                '/dashboard',
                [DashboardController::class, 'manager']
            )->name('dashboard');

        });

    //Multiple roles access
    // Route::middleware([
    //     'auth',
    //     'role:Admin IT,Manager'
    // ])->group(function () {

    //     Route::get('/reports', function () {
    //         return 'Report Page';
    //     });

    // });
    Route::middleware('role:Admin IT,Manager')
        ->group(function () {

            Route::get('/reports', function () {
                return 'Report Page';
            });

        });
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



require __DIR__ . '/auth.php';
