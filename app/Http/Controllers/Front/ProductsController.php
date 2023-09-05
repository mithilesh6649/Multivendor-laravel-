<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
class ProductsController extends Controller
{
    public static function listing(){
         $url = Route::getFacadeRoot()->current()->uri();
         $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
         if($categoryCount){
            $categoryDetails = Category::categoryDetails($url);
            dd($categoryDetails);  
         }else{
            abort(404);
         }
    }
}
