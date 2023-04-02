<?php

use Illuminate\Support\Facades\Route;

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

require __DIR__ . '/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {

//Admin Login Route
Route::match(['get', 'post'], 'login', 'AdminController@login')->name('admin.login');

    Route::group(['middleware' => ['admin']], function () {

//Admin Dashboard route
        Route::get('dashboard', 'AdminController@dashboard');

//Admin logout
        Route::get('/logout', 'AdminController@logout')->name('admin.logout');

//Update Admin Password
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword')->name('admin.update.password');

        Route::post('chekc-admin-password', 'AdminController@checkAdminPassword')->name('admin.check.password');

//Update Admin Details
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails')->name('admin.update.details');

//Update Vendor Details

        Route::match(['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails');

        //20:- View admins / Subadmins / Vendors

        Route::get('admins/{type?}', 'AdminController@admins');

        //21 :- View venodr details

        
    Route::get('view-vendor-details/{id}', 'AdminController@viewVendorDetails')->name('view.vendor.details');

        // 22 :- Update admin status

        Route::post('update-admin-status', 'AdminController@updatedAdminStatus')->name('update.admin.status');

        // 23 :- Sections coding start

        Route::get('sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updatedSectionStatus')->name('update.section.status');

        Route::get('delete-section/{id}', 'SectionController@deletesection');

        Route::match(['get', 'post'], 'add-edit-section/{id?}', 'SectionController@addEditSection');

        // Category Coding Start
        Route::get('categories', 'CategoryController@categories');
        
        Route::post('update-category-status', 'CategoryController@updatedCategoryStatus')->name('update.category.status');
        
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
       
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');

         Route::get('brands', 'BrandController@brands');
         Route::post('update-brand-status', 'SectionController@updatedSectionStatus')->name('update.brand.status');

         //Product Section started.......ProductController
   


        Route::get('products', 'ProductController@products');
        Route::post('update-products-status', 'ProductController@updatedProductsStatus')->name('update.products.status');

        Route::get('delete-product/{id}', 'ProductController@deleteproducts');

        Route::match(['get','post'],'add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductController@deleteProductvideo');

        //Attributes.........

        Route::match(['get','post'],'add-edit-attributes/{id}','ProductController@addAttributes');

         Route::post('update-attribute-status', 'ProductController@updatedAttributeStatus')->name('update.attribute.status');
         Route::get('delete-attribute/{id}', 'ProductController@deleteAttribute');
         Route::post('edit-attributes/{id}','ProductController@editAttributes');

           Route::match(['get','post'],'add-images/{id}','ProductController@addImages');

        
    });

});
