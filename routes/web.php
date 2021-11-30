<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\V1\Frontend\User\AjaxController;
use App\Http\Controllers\V1\Backend\Admin\DashboardController;

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
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');

// Routes define with groups for admin and user
Route::group(['middleware' => 'auth'], function () {
    // this middleware apply for all admin routes
    Route::group(['prefix'=>'admin'], function () {
        //namespace for app/http/controller/ access this path for all admin controller
        Route::group(['namespace' => 'V1\Backend\Admin'], function () {
            // define admin routes
            Route::get('/admin_profile', 'AdminController@adminProfile')->name('admin.adminProfile');
            Route::post('/admin_save_profile', 'AdminController@saveProfile')->name('admin.saveProfile');
            Route::get('{role}/users', 'Roles\RoleController@rolesAttachedUsers')->name('roles.attached.users');
            Route::get('{role}/permissions', 'Roles\RolePermissionsController@rolePermissions')->name('roles.permissions');
            Route::post('{role}/permissions', 'Roles\RolePermissionsController@rolePermissionsStore')->name('roles.permissions.store');

            Route::resource('roles', 'Roles\RoleController');
        });
    });
});

