<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController; 

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



Route::get('/clear', function () {
      \Artisan::call('route:clear');
       \Artisan::call('config:clear');
       \Artisan::call('view:clear');
       \Artisan::call('cache:clear');
       \Artisan::call('optimize');
       
      return "All cache clear Success";
});
 


Route::get('/', function () {
      \Artisan::call('route:clear');
      return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

//Admin Login Route
Route::match(['get','post'],'login','AdminController@login')->name('admin.login');


Route::group(['middleware'=>['admin']],function(){

//Admin Dashboard route
Route::get('dashboard','AdminController@dashboard');

//Admin logout
Route::get('/logout','AdminController@logout')->name('admin.logout');

//Update Admin Password
Route::match(['get','post'],'update-admin-password','AdminController@updateAdminPassword')->name('admin.update.password');


Route::post('chekc-admin-password','AdminController@checkAdminPassword')->name('admin.check.password');

//Update Admin Details
Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails')->name('admin.update.details');

//Update Vendor Details

Route::match(['get','post'],'update-vendor-details/{slug}','AdminController@updateVendorDetails');

 //20:- View admins / Subadmins / Vendors

  Route::get('admins/{type?}','AdminController@admins');


  });

});

 


