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
    return \Illuminate\Support\Facades\Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Locale Switch
|--------------------------------------------------------------------------
*/
Route::post('/locale', function (\Illuminate\Http\Request $r) {
    $locale = $r->input('locale');
    $loc = in_array($locale, ['ar','en']) ? $locale : config('app.locale');
    if (\Illuminate\Support\Facades\Auth::check()) {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user instanceof \Illuminate\Database\Eloquent\Model) {
            $user->locale = $loc;
            $user->save();
        }
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
        // إدارة الأمراض المزمنة
        Route::resource('chronic-diseases', App\Http\Controllers\ChronicDiseaseController::class)
            ->middleware([
                'permission:chronic-diseases.view|chronic-diseases.create|chronic-diseases.update|chronic-diseases.delete'
            ]);
        // Super Admin: Admins & Roles Management
        Route::prefix('admin')->name('admin.')->middleware(['role:super_admin'])->group(function () {
            Route::resource('admins', App\Http\Controllers\Admin\AdminController::class)->except(['show']);
            Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->except(['show']);
        });

        // لوحة الأدمن
        Route::get('/admin', fn () => view('admin.dashboard'))->name('admin.dashboard');
        Route::get('/admin/settings', fn () => view('admin.settings'))->name('admin.settings');

        // إدارة الخدمات
    Route::resource('services', App\Http\Controllers\ServiceController::class)->except(['show']);
    Route::post('services/{service}/toggle', [App\Http\Controllers\ServiceController::class, 'toggle'])->name('services.toggle');

        // إدارة المرضى
        Route::resource('patients', App\Http\Controllers\PatientController::class)->except(['show']);

        // إدارة الزيارات
    Route::get('/visits/create', [App\Http\Controllers\VisitController::class, 'create'])->name('visits.create');
    Route::post('/visits', [App\Http\Controllers\VisitController::class, 'store'])->name('visits.store');
    Route::get('/visits/{visit}/edit', [App\Http\Controllers\VisitController::class, 'edit'])->name('visits.edit');
    Route::put('/visits/{visit}', [App\Http\Controllers\VisitController::class, 'update'])->name('visits.update');

        // باقي القوائم الأساسية
    Route::get('/visits', [App\Http\Controllers\VisitController::class, 'index'])->name('visits.index')->middleware('permission:visits.view');
        Route::get('/prescriptions',   fn () => 'Prescriptions')->name('prescriptions.index')->middleware('permission:visits.view');
        Route::get('/labs',            fn () => 'Labs')->name('labs.index')->middleware('permission:labs.manage');
        Route::get('/files',           fn () => 'Files')->name('files.index')->middleware('permission:files.manage');
    });
});

require __DIR__ . '/auth.php';
