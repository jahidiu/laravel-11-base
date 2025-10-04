<?php

use Illuminate\Support\Facades\Route;
use Modules\Base\App\Http\Controllers\DonationTypeController;
use Modules\Base\App\Http\Controllers\GeneralSettingController;
use Modules\Base\App\Http\Controllers\MailConfigController;

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


Route::group(['middleware' => 'auth', 'prefix' => 'base'], function () {

    Route::controller(GeneralSettingController::class)->group(function () {
        Route::get('/setting', 'index')->name('setting.index')->middleware('permission:general.setting');
        Route::get('/donation-setting', 'donationSetting')->name('setting.donation')->middleware('permission:general.setting');
        Route::post('/setting', 'store')->name('setting.store');
        Route::get('/setting/Qr-code', 'qrCodeSetting')->name('setting.qr_code')->middleware('permission:setting.qr_code');
    });

    Route::controller(MailConfigController::class)->group(function () {
        Route::get('/mail-setup', 'mailSetup')->name('mail.setup')->middleware('permission:mail.setup');
        Route::post('/test-mail', 'testMail')->name('mail.test')->middleware('permission:mail.test');
        Route::post('/update-mail-settings', 'updateMailSettings')->name('mail.update_settings');
    });

    Route::controller(DonationTypeController::class)->middleware('auth')->group(function () {
        Route::get('/donation-type', 'index')->name('donation_type.index')->middleware('permission:donation_type.list');
        Route::get('/donation-type-list', 'get_for_select')->name('donation_type.list');
        Route::post('/donation-type', 'store')->name('donation_type.store')->middleware('permission:donation_type.create');
        Route::get('/donation-type/{donation_type}/edit', 'edit')->name('donation_type.edit')->middleware('permission:donation_type.edit');
        Route::put('/donation-type/{donation_type}', 'update')->name('donation_type.update')->middleware('permission:donation_type.edit');
        Route::delete('/donation-type/{donation_type}', 'destroy')->name('donation_type.destroy')->middleware('permission:donation_type.delete');
    });

});
