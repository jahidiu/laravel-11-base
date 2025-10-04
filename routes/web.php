<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/cc', function () {
    \Artisan::call('storage:link');
    \Artisan::call('optimize:clear');
    return back()->with('success', 'Cache Clear Successfully!');
});


Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('permission:dashboard');
    Route::get('/user-profile', [HomeController::class, 'userProfile'])->name('user.profile')->middleware('permission:user.profile');
    Route::post('/user-profile', [HomeController::class, 'updateUserProfile'])->name('user.update_profile')->middleware('permission:user.update_profile');
});

Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/user', 'index')->name('user.index')->middleware('permission:user.list');
    Route::post('/user', 'store')->name('user.store')->middleware('permission:user.create');
    Route::get('/user/{user}/edit', 'edit')->name('user.edit')->middleware('permission:user.edit');
    Route::put('/user/{user}', 'update')->name('user.update')->middleware('permission:user.edit');
    Route::delete('/user/{user}', 'destroy')->name('user.destroy')->middleware('permission:user.delete');
});
Route::controller(RoleController::class)->middleware('auth')->group(function () {
    Route::get('/role', 'index')->name('role.index')->middleware('permission:role.list');
    Route::post('/role', 'store')->name('role.store')->middleware('permission:role.create');
    Route::get('/role/{role}/edit', 'edit')->name('role.edit')->middleware('permission:role.edit');
    Route::put('/role/{role}', 'update')->name('role.update')->middleware('permission:role.edit');
    Route::delete('/role/{role}', 'destroy')->name('role.destroy')->middleware('permission:role.delete');
    Route::get('/role-permission/{role}', 'rolePermission')->name('role.permission')->middleware('permission:role.permission');
    Route::post('/role-assign-permission', 'roleAssignPermission')->name('role.assign.permission')->middleware('permission:role.assign.permission');
    Route::get('/role-list', 'get_for_select')->name('role.list');
});
