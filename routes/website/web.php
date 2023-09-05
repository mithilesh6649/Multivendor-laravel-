<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ProductsController;
use App\Models\Category;
/*
|--------------------------------------------------------------------------
| Website / Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
 
 Route::get('/',[IndexController::class,'index']);

 // Listing/Categories Routes..
 
  $catUrls = Category::active()->select('url')->get()->pluck('url')->toArray();
  
  foreach($catUrls as $key => $url){
      Route::get('/'.$url,[ProductsController::class,'listing']);
  }
  
  


?>