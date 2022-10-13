<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\SchoolSetup\ManagementController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//Route for all the database management functions
Route::prefix('manage')->group(function(){
    Route::get('/class/view', [ManagementController::class, 'viewClass'])->name('class.view');
    Route::get('/class/add', [ManagementController::class, 'addClass'])->name('class.add');
    Route::post('/class/store', [ManagementController::class, 'storeClass'])->name('class.store');
    Route::get('/class/edit/{id}', [ManagementController::class, 'editClass'])->name('class.edit');
    Route::post('/class/update/{id}', [ManagementController::class, 'updateClass'])->name('class.update');
});


