<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\TestParameterController;
use App\Http\Controllers\SampleTestController;
use App\Http\Controllers\QAApprovalController;
use App\Http\Controllers\COAController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\BatchTraceabilityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GlobalSearchController;

Route::get('/', function () {

    return redirect()->route('dashboard');

})->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

   Route::resource('companies', CompanyController::class);

   Route::resource('products', ProductController::class);
   Route::resource('samples', SampleController::class);

   Route::get('/company-products/{company_id}',[SampleController::class,'getProducts'])->name('company.products');

    Route::resource('test-parameters',TestParameterController::class
);
Route::get(
'/sample-tests/create/{sample_id}',
[SampleTestController::class,'create']
)
->name('sample-tests.create');



Route::post(
'/sample-tests/store',
[SampleTestController::class,'store']
)
->name('sample-tests.store');


Route::get(
'/sample-tests',
[SampleTestController::class,'index']
)
->name('sample-tests.index');



Route::get(
'/sample-tests/{sampleTest}/edit',
[SampleTestController::class,'edit']
)
->name('sample-tests.edit');



Route::put(
'/sample-tests/{sampleTest}',
[SampleTestController::class,'update']
)
->name('sample-tests.update');

Route::get(
'/qa-approval',
[QAApprovalController::class,'index']
)
->name('qa.index');



Route::post(
'/qa-approval/{sample}/approve',
[QAApprovalController::class,'approve']
)
->name('qa.approve');



Route::post(
'/qa-approval/{sample}/reject',
[QAApprovalController::class,'reject']
)
->name('qa.reject');


Route::get(
'/coa/{sample}',
[COAController::class,'generate']
)
->name('coa.generate');


Route::resource('users', UserController::class);
Route::get(
    '/audit-trails',
    [AuditTrailController::class,'index']
)
->name('audit.index');

Route::get('/activity-logs', [ActivityLogController::class, 'index'])
    ->name('activity.index');

    Route::get(
'/coa/create/{sample_id}',
[COAController::class,'create']
)
->name('coa.create');


Route::post(
'/coa/store',
[COAController::class,'store']
)
->name('coa.store');

Route::get('/coa',
[COAController::class,'index'])
->name('coa.index');


Route::get(
'/batch-traceability',
[BatchTraceabilityController::class,'index']
)
->name('batch.index');


Route::post(
'/batch-traceability/search',
[BatchTraceabilityController::class,'search']
)
->name('batch.search');


Route::get(
'/reports',
[ReportController::class,'index']
)
->name('reports.index');

Route::resource('settings', SettingController::class);

Route::get(
    '/settings',
    [SettingController::class,'index']
)->name('settings.index');

Route::post(
    '/settings',
    [SettingController::class,'store']
)->name('settings.store');


Route::get(
'/coa/{sample}/mail',
[COAController::class,'sendMail']
)->name('coa.mail');

Route::get('/reports/sample', [ReportController::class,'sampleReport'])
    ->name('report.sample');
Route::get('/reports/pdf', [ReportController::class,'pdf'])
    ->name('report.pdf');


Route::get(
'/search',
[GlobalSearchController::class,'index']
)
->name('global.search');

});



require __DIR__.'/auth.php';
