<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Locale Switch
|--------------------------------------------------------------------------
*/
Route::post('/locale', function (\Illuminate\Http\Request $r) {
    $loc = in_array($r->locale, ['ar','en']) ? $r->locale : config('app.locale');
    if (auth()->check()) {
        auth()->user()->update(['locale' => $loc]);
    } else {
        session(['locale' => $loc]);
    }
    return back();
})->name('locale.set');

/*
|--------------------------------------------------------------------------
| Authenticated Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard (مرة واحدة فقط)
    Route::get('/dashboard', fn () => view('dashboard'))
        ->middleware(['verified']) // لو مش عايز التحقق شيلها
        ->name('dashboard');

    // Profile
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Admin Area (Role: admin) + Permissions (Spatie)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        // Super Admin: Admins Management
        Route::prefix('admin')->name('admin.')->middleware(['role:super_admin'])->group(function () {
            Route::resource('admins', App\Http\Controllers\Admin\AdminController::class)->except(['show']);
        });

        // لوحة الأدمن
        Route::get('/admin', fn () => view('admin.dashboard'))->name('admin.dashboard');
        Route::get('/admin/settings', fn () => view('admin.settings'))->name('admin.settings');

        // قوائم أساسية (Placeholder لحد ما تعمل Controllers)
        Route::get('/patients',        fn () => 'Patients')->name('patients.index')->middleware('permission:patients.view');
        Route::get('/visits',          fn () => 'Visits')->name('visits.index')->middleware('permission:visits.view');
        Route::get('/prescriptions',   fn () => 'Prescriptions')->name('prescriptions.index')->middleware('permission:visits.view');
        Route::get('/labs',            fn () => 'Labs')->name('labs.index')->middleware('permission:labs.manage');
        Route::get('/files',           fn () => 'Files')->name('files.index')->middleware('permission:files.manage');
    });
});

require __DIR__ . '/auth.php';
